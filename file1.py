from turtle import update
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
import json
#import pandas as pd

def write_to_file(dict) :
    with open("sample.json", "w") as outfile:
        data = json.loads( outfile )

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
    
    if( len(newdata) >1 ):
        count += 1
        dict[newdata[0]] = newdata[1]

        if( count == 19 ):
            #print(dict)
            dict["datetime"] = str(datetime_object)
            json_object = json.dumps(dict)
            write_to_file(dict)
            print(json_object)
            count = 0
            dict = {}
            # URl='https://api.thingspeak.com/channels/1554808/bulk_update.json'
            # KEY='OWW4C0TPLPKDV3FW'
            # HEADER='&field1={}'.format(data)
            
    
    
    # db.collection('collection').add(dict)
    
    # NEW_URL = URl+KEY+HEADER
    # print(NEW_URL)
    # data=urllib.request.urlopen(NEW_URL)
    # print(data)


