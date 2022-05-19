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
import pandas as pd

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
            df = pd.read_json(json_object ,  typ='series')
            print(df)
            df.to_csv('courses.csv')

            db.collection('sensor').add(dict)

            with open("sample.json", "r+") as outfile:
                if len(outfile.read()) == 0:
                    outfile.write(json_object)
                else:
                    outfile.write(',\n' + json_object)
                    
           # print(json_object)
            count = 0
            dict = {}

            # URl='https://api.thingspeak.com/channels/1554808/bulk_update.json'
            # KEY='OWW4C0TPLPKDV3FW'
            # HEADER='&field1={}'.format(data)