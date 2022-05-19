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

ser = serial.Serial(port='COM7', baudrate=115200, timeout=.100)


while True:
    data = ser.readline().decode('utf-8').rstrip()
    print(data)
    db.collection('value').add({'MQ1' : data , 'date' : datetime_object})
    URl='https://api.thingspeak.com/update?api_key='
    KEY='OWW4C0TPLPKDV3FW'
    HEADER='&field1={}'.format(data)
    NEW_URL = URl+KEY+HEADER
    print(NEW_URL)
    data=urllib.request.urlopen(NEW_URL)
    print(data)


