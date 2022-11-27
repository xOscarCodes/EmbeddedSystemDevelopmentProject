import cv2
import numpy as np
import os

# directory = "images"
# way = os.path.join("src/", directory)
# os.mkdir(way)

# print("Directory '% s' created" % directory)

face_classifier = cv2.CascadeClassifier(
    'cascades/data/haarcascade_frontalface_alt2.xml')


def face_extractor(img):

    gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
    faces = face_classifier.detectMultiScale(gray, 1.3, 5)

    if faces is ():
        return None

    for (x, y, w, h) in faces:
        cropped_face = img[y:y+h, x:x+w]

    return cropped_face


cap = cv2.VideoCapture(0)
count = 0
name = "jaggi"

directory = name
parent_dir = "images/"
way = os.path.join(parent_dir, directory)
mode = 0o666
os.mkdir(way, mode)
cmd = "chmod 777 images/"+name
os.system(cmd)

while True:

    ret, frame = cap.read()
    if face_extractor(frame) is not None:
        count += 1
        face = cv2.resize(face_extractor(frame), (200, 200))
        face = cv2.cvtColor(face, cv2.COLOR_BGR2GRAY)

        file_name_path = 'images/' + name + '/'+str(count)+'.jpg'

        cv2.imwrite(file_name_path, face)

        cv2.putText(face, str(count), (50, 50),
                    cv2.FONT_HERSHEY_COMPLEX, 1, (0, 255, 0), 2)
        cv2.imshow('Face Cropper', face)
    else:
        print("Face not found")
        pass

    if cv2.waitKey(1) == 13 or count == 100:
        break

cap.release()
cv2.destroyAllWindows()
print('Samples Colletion Completed ')
