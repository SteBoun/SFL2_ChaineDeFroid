#!/usr/bin/python
import mysql.connector

db = mysql.connector.connect(
                     user="admin",         # your username
                     password="Motdepasse",  # your password
                     host="127.0.0.1",   # your host, usually localhost
                     database="proxidej")        # name of the data base

cur = db.cursor()

sql = "INSERT INTO livraison (temp, posX, posY, id) VALUES (%d, %d, %d, %d)"
val = ("Mettre_la_temperature", "Mettre_la_longitude", "Mettre_la_lantitude", "Mettre_id_voiture")
cur.execute(sql, val)
db.commit()

db.close()