import serial, time
import smbus
import math
import RPi.GPIO as GPIO
import struct
import sys

ser = serial.Serial('/dev/ttyAMA0', 9600, timeout = 0)
ser.flush()

class GPS:
	inp=[]
	
	GGA=[]
	
	def read(self):
		while True:
			GPS.inp=ser.readline()
			if GPS.inp[:6] =='$GPGGA': # GGA data , packet 1, has all the data we need
				break
			time.sleep(0.1)
		try:
			ind=GPS.inp.index('$GPGGA',5,len(GPS.inp))
			GPS.inp=GPS.inp[ind:]
		except ValueError:
			print ("")
		GPS.GGA=GPS.inp.split(",")
		return [GPS.GGA]
	def vals(self):
        	time=GPS.GGA[1]
        	lat=GPS.GGA[2]
        	lat_ns=GPS.GGA[3]
        	long=GPS.GGA[4]
        	long_ew=GPS.GGA[5]
        	fix=GPS.GGA[6]
        	sats=GPS.GGA[7]
        	alt=GPS.GGA[9]
        	return [time,fix,sats,alt,lat,lat_ns,long,long_ew]

g=GPS()
f=open("gps_data.csv",'w')  #Open file to log the data
f.write("name,latitude,longitude\n")
ind=0
while True:
    try:
        x=g.read()  #Read from GPS
        [t,fix,sats,alt,lat,lat_ns,long,long_ew]=g.vals()   #Get the individial values
        print ("Time:",t,"Fix status:",fix,"Sats in view:",sats,"Altitude",alt,"Lat:",lat,lat_ns,"Long:",long,long_ew)
        s=str(t)+","+str(float(lat)/100)+","+str(float(long)/100)+"\n"
        f.write(s)  #Save to file
        time.sleep(2)
    except IndexError:
        print ("Unable to read")
    except KeyboardInterrupt:
        f.close()
        print ("Exiting")
        sys.exit(0)
