#!/usr/bin/env python
#-*- coding: utf-8 -*-

import serial, time ,sys

GPS = serial.Serial('/dev/ttyAMA0', 9600, timeout = 0)
GPS.flush()

while True:
	Data=GPS.readline()
	time.sleep(0.5)
	print(Data)
