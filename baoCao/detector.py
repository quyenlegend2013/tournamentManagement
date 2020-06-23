import cv2
import numpy as np

recognizer = cv2.face.LBPHFaceRecognizer_create()
recognizer.read('trainner/trainner.yml')
cascadePath = "haarcascade_frontalface_default.xml"
faceCascade = cv2.CascadeClassifier(cascadePath);

cam = cv2.VideoCapture(0)
font = cv2.FONT_HERSHEY_SIMPLEX
num = 0
while True:
    ret, im =cam.read()
    gray=cv2.cvtColor(im,cv2.COLOR_BGR2GRAY)
    faces=faceCascade.detectMultiScale(gray, 1.2,5)
    for(x,y,w,h) in faces:
        cv2.rectangle(im,(x,y),(x+w,y+h),(225,0,0),1)
        Id, conf = recognizer.predict(gray[y:y+h,x:x+w])
       # print(str(conf) + "  -  " + str(Id))
        num = num + 1
        if(conf <54):
            if(Id == 1):
                # Id="quyen"
                print(1)
                cam.release()
            elif(Id == 7):
                print(1)
                cam.release()
            elif(Id == 6):
                print(1)
                cam.release()
            elif(Id == 5):
                print(1)
                cam.release()
        else:
            Id="Unknown"
        #cv2.putText(im,str(Id), (x,y+h),font,1, (0,255,0),0)
    cv2.imshow('Your face',im) 
    if cv2.waitKey(10) == ord('q'):
        break
    # elif(num>100):
    #     break
cam.release()
cv2.destroyAllWindows()
