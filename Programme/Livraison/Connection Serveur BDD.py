#!/usr/bin/python
import mysql.connector

db = mysql.connector.connect(
                     user="admin",         # your username
                     password="Motdepasse",  # your password
                     host="127.0.0.1",   # your host, usually localhost
                     database="proxidej")        # name of the data base

cur = db.cursor()
temp = 3.5
long = 25.4502
lat = 15.4520
id_car = 1
sql = "INSERT INTO livraison (temp, posX, posY, id) VALUES (%f, %lf, %lf, %d)"
val = (temp, long, lat, id_car)
cur.execute(sql, val)
db.commit()

db.close()