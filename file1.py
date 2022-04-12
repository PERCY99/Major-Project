import serial
from serial import Serial
import time
import urllib.request
import requests
import threading
import json
import firebase_admin
from firebase_admin import credentials
from firebase_admin import firestore
import datetime

datetime_object = datetime.datetime.now()



cred = credentials.Certificate("serviceAccountKey.json")
firebase_admin.initialize_app(cred)

db = firestore.client()

ser = serial.Serial(port='COM6', baudrate=9600)

dict = {}

count = 0
while True:
    data = ser.readline().decode('utf-8').rstrip()
    
    newdata = data.split()
    
    if( len(newdata) !=0 ):
        count += 1
        dict[newdata[0]] = newdata[1]

        if( count == 19 ):
            print(dict)
            count = 0
            dict = {}
            # URl='https://api.thingspeak.com/update?api_key='
            # KEY='OWW4C0TPLPKDV3FW'
            # HEADER='&field1={}'.format(data)
    
    
    # db.collection('collection').add(dict)
    
    # NEW_URL = URl+KEY+HEADER
    # print(NEW_URL)
    # data=urllib.request.urlopen(NEW_URL)
    # print(data)


