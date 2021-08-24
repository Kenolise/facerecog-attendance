import face_recognition
import cv2
import MySQLdb
from datetime import datetime
from time import gmtime, strftime
video_capture = cv2.VideoCapture(0)
import sys
imgname="" #collect photos
studname="" #collect studentname

def markattend(name,reg1):
    db=db=MySQLdb.connect(host="localhost",user="root",password="",db="attendance")
    cur=db.cursor()
    attime=str(datetime.now())
    attime="'"+attime+"'"
    query="insert into markme(reg,Studentname,attime) values("+str(int(reg1))+","+name+","+attime+");"
    cur.execute(query)
    db.commit()
    db.close()

def collectphotos(name):
    global imgname
    global studname
    db=db=MySQLdb.connect(host="localhost",user="root",password="",db="attendance")
    cur=db.cursor()
    name=int(name) #registration number
    query="select * from studentdata where reg="+str(name)+";"
    cur.execute(query)
    for row in cur.fetchall():
        imgname=row[3]
        studname=row[2]
    db.close()

reg1=sys.argv[1]#getting the parameter outside php
collectphotos(reg1)
imagen=imgname

#print(imagen)
studn="'"+studname+"'"

#print(imagen)
#print(studn)
Picture_face_encoding=[]
Pic_image = face_recognition.load_image_file("ImagesAttendance")

#print(Pic_image)
Pic_face_encoding = face_recognition.face_encodings(Pic_image)[0]
face_locations = []
face_encodings = []
face_names = []
process_this_frame = True
k=0
p=0
name="Unknown"
while True:
    ret, frame = video_capture.read()
    small_frame = cv2.resize(frame,(224,224),fx=0,fy=0, interpolation = cv2.INTER_CUBIC)

    if process_this_frame:
        face_locations = face_recognition.face_locations(small_frame)
        face_encodings = face_recognition.face_encodings(small_frame, face_locations)
        face_names = []
        for face_encoding in face_encodings:
            match = face_recognition.compare_faces([Pic_face_encoding], face_encoding)
            name = "Unknown"
            if match[0]:
                name = studn
                #print(name)
            face_names.append(name)
    process_this_frame = not process_this_frame
    for (top, right, bottom, left), name in zip(face_locations, face_names):
        top *= 4
        right *= 4
        bottom *= 4
        left *= 4
        cv2.rectangle(frame, (left, top), (right, bottom), (0, 0, 255), 2)
        cv2.rectangle(frame, (left, bottom - 35), (right, bottom), (0, 0, 255), cv2.FILLED)
        font = cv2.FONT_HERSHEY_DUPLEX
        cv2.putText(frame, name, (left + 6, bottom - 6), font, 1.0, (255, 255, 255), 1)
    cv2.imshow('Video', frame)
    if k<=10 and name!="Unknown":
        k+=1
        if k==10:
            p=1
            if(p==1):
                markattend(name,reg1)  #functioncall
            break
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break
    
video_capture.release()
cv2.destroyAllWindows()
