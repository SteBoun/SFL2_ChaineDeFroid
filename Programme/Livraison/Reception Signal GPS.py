#!/usr/bin/python
from time import sleep
import serial, time
import smbus
import math
import RPi.GPIO as GPIO
import struct
import sys
import urllib2
import mysql.connector
from pi_sht1x import SHT1x
# import ir_receiver_check

enable_debug = 1
enable_save_to_file = 0

# if ir_receiver_check.check_ir():
#   print("Disable IR receiver before continuing")
#   exit()

ser = serial.Serial('/dev/ttyAMA0', 9600, timeout=0)  # Open the serial port at 9600 baud
ser.flush()


m_lat = 0
m_long = 0
m_temp = 0

DATA_PIN = 21
SCK_PIN = 23

with SHT1x(DATA_PIN, SCK_PIN, gpio_mode=GPIO.BOARD) as sensor:
    m_temp = sensor.read_temperature()
    sleep(2)


def cleanstr(in_str):
    out_str = "".join([c for c in in_str if c in "0123456789.-"])
    if len(out_str) == 0:
        out_str = "-1"
    return out_str


def safefloat(in_str):
    try:
        out_str = float(in_str)
    except ValueError:
        out_str = -1.0
    return out_str


class GPS:
        # The GPS module used is a Grove GPS module http://www.seeedstudio.com/depot/Grove-GPS-p-959.html
    inp = []
        # Refer to SIM28 NMEA spec file http://www.seeedstudio.com/wiki/images/a/a0/SIM28_DATA_File.zip
    GGA = []

        # Read data from the GPS
    def read(self):
        while True:
            GPS.inp = ser.readline()
            if GPS.inp[:6] == '$GPGGA':  # GGA data , packet 1, has all the data we need
                break
            time.sleep(0.1)  # without the cmd program will crash
        try:
            ind = GPS.inp.index('$GPGGA', 5, len(
                GPS.inp))  # Sometimes multiple GPS data packets come into the stream. Take the data only after the last '$GPGGA' is seen
            GPS.inp = GPS.inp[ind:]
        except ValueError:
            print("")
            GPS.GGA = GPS.inp.split(",")  # Split the stream into individual parts
        return [GPS.GGA]

        # Split the data into individual elements
    def vals(self):
        if enable_debug:
            print(GPS.GGA)

        time = GPS.GGA[1]

        if GPS.GGA[2] == '':  # latitude. Technically a float
            m_lat = -1.0
        else:
            m_lat = safefloat(cleanstr(GPS.GGA[2]))

        if GPS.GGA[3] == '':  # this should be either N or S
            lat_ns = ""
        else:
            lat_ns = str(GPS.GGA[3])

        if GPS.GGA[4] == '':  # longitude. Technically a float
            m_long = -1.0
        else:
            m_long = safefloat(cleanstr(GPS.GGA[4]))

        if GPS.GGA[5] == '':  # this should be either W or E
            long_ew = ""
        else:
            long_ew = str(GPS.GGA[5])

        fix = int(cleanstr(GPS.GGA[6]))
        sats = int(cleanstr(GPS.GGA[7]))

        if GPS.GGA[9] == '':
            alt = -1.0
        else:
                # change to str instead of float
                # 27"1 seems to be a valid value
            alt = str(GPS.GGA[9])
        return [time, fix, sats, alt, m_lat, lat_ns, m_long, long_ew]

        # Convert to decimal degrees
    def decimal_degrees(self, raw_degrees):
        try:
            degrees = float(raw_degrees) // 100
            d = float(raw_degrees) % 100 / 60
            return degrees + d
        except:
            return raw_degrees


if __name__ == "__main__":
    g = GPS()
    if enable_save_to_file:
        f = open("gps_data.csv", 'w')  # Open file to log the data
        f.write("name,latitude,longitude,temperature\n")  # Write the header to the top of the file
    ind = 0
    while True:
        time.sleep(1)
        try:
            x = g.read()  # Read from GPS
            [t, fix, sats, alt, m_lat, lat_ns, m_long, long_ew] = g.vals()  # Get the individial values

                # Convert to decimal degrees
            if m_lat != -1.0:
                m_lat = g.decimal_degrees(safefloat(m_lat))
                if lat_ns == "S":
                    m_lat = -m_lat

            if m_long != -1.0:
                m_long = g.decimal_degrees(safefloat(m_long))
                if long_ew == "W":
                    m_long = -m_long

                # print ("Time:",t,"Fix status:",fix,"Sats in view:",sats,"Altitude",alt,"Lat:",lat,lat_ns,"Long:",long,long_ew)
            try:
                print(
                    "Time\t\t: %s\nFix status\t: %d\nSats in view\t: %d\nAltitude\t: %s\nLat\t\t: %f\nLong\t\t: %f") % (
                    t, fix, sats, alt, m_lat, m_long)
            except:
                print(
                    "Time\t\t: %s\nFix status\t: %s\nSats in view\t: %s\nAltitude\t: %s\nLat\t\t: %s\nLong\t\t: %s") % (
                    t, str(fix), str(sats), str(alt), str(m_lat), str(m_long))

            s = str(t) + "," + str(safefloat(m_lat) / 100) + "," + str(safefloat(m_long) / 100) + "," + str(safefloat(m_temp) / 100) + "\n"

            if enable_save_to_file:
                f.write(s)  # Save to file
            time.sleep(2)
        except IndexError:
            print("Unable to read")
        except KeyboardInterrupt:
            if enable_save_to_file:
                f.close()
            print("Exiting")
            sys.exit(0)

# TEST CONNECTION
def internet_on():
    try:
        urllib2.urlopen('http://www.google.com', timeout=1)
        return True
    except urllib2.URLError as err:
        return False

if internet_on() == True:
    db = mysql.connector.connect(
        user="admin",  # your username
        password="Motdepasse",  # your password
        host="127.0.0.1",  # your host, usually localhost
        database="proxidej")  # name of the data base
    cur = db.cursor()
    while True:  # Boucle infini jusqu'a arret du programme
        id_car = 1
        sql = "INSERT INTO livraison (temp, posX, posY, id) VALUES (%f, %lf, %lf, %d)"
        val = (m_temp, m_long, m_lat, id_car)
        cur.execute(sql, val)
        db.commit()
        time.sleep(5)