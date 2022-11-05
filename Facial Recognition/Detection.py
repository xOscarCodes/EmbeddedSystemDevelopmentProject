# import cv2
# import numpy as np
# import os
# from os import listdir
# from os.path import isfile, join

# data_path = 'images/'
# onlyfiles = [f for f in listdir(data_path) if isfile(join(data_path, f))]

# Training_Data, Labels = [], []

# for i, files in enumerate(onlyfiles):
#     image_path = data_path + onlyfiles[i]
#     images = cv2.imread(image_path, cv2.IMREAD_GRAYSCALE)
#     # Training_Data.append(np.asarray(images, dtype=np.str_))
#     Labels.append(i)

# Labels = np.asarray(Labels, dtype=np.int32)

# model = cv2.face.LBPHFaceRecognizer_create()

# # model.train(np.asarray(Training_Data), np.asarray(Labels))

# print("Dataset Model Training Complete!!!!!")

# face_classifier = cv2.CascadeClassifier(
#     'cascades/data/haarcascade_frontalface_alt2.xml')


# def face_detector(img, size=0.5):
#     gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
#     faces = face_classifier.detectMultiScale(gray, 1.3, 5)

#     if faces is ():
#         return img, []

#     for (x, y, w, h) in faces:
#         cv2.rectangle(img, (x, y), (x+w, y+h), (0, 255, 0), 2)
#         roi = img[y:y+h, x:x+w]
#         roi = cv2.resize(roi, (200, 200))

#     return img, roi


# BASE_DIR = os.path.dirname(os.path.abspath(__file__))
# image_dir = os.path.join(BASE_DIR, "images")


# cap = cv2.VideoCapture(0)
# while True:

#     ret, frame = cap.read()

#     image, face = face_detector(frame)

#     # for root, dirs in os.walk(image_dir):

#     try:
#         face = cv2.cvtColor(face, cv2.COLOR_BGR2GRAY)
#         result = model.predict(face)

#      # for root, dirs in os.walk(image_dir):
#         if result[1] < 500:
#             confidence = int(100*(1-(result[1])/300))

#         if confidence > 82:
#             cv2.putText(image, "Yohjit", (250, 450),
#                         cv2.FONT_HERSHEY_COMPLEX, 1, (255, 255, 255), 2)
#             print("Yohjit")
#             cv2.imshow('Face Cropper', image)

#         else:
#             cv2.putText(image, "Unknown", (250, 450),
#                         cv2.FONT_HERSHEY_COMPLEX, 1, (0, 0, 255), 2)
#             cv2.imshow('Face Cropper', image)

#     except:
#         cv2.putText(image, "Face Not Found", (250, 450),
#                     cv2.FONT_HERSHEY_COMPLEX, 1, (255, 0, 0), 2)
#         cv2.imshow('Face Cropper', image)
#         pass

#     if cv2.waitKey(1) == 13:
#         break


# cap.release()
# cv2.destroyAllWindows()

import numpy as np
import cv2
import pickle
import os

cap = cv2.VideoCapture(0)

face_cascade = cv2.CascadeClassifier(
    'cascades/data/haarcascade_frontalface_alt2.xml')

recognizer = cv2.face.LBPHFaceRecognizer_create()
recognizer.read("face-trainner.yml")

# def face_detector(img, size=0.5):
#     gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
#     faces = face_cascade.detectMultiScale(gray, 1.3, 5)

#     if faces is ():
#         return img, []

#     for (x, y, w, h) in faces:
#         cv2.rectangle(img, (x, y), (x+w, y+h), (0, 255, 0), 2)
#         roi = img[y:y+h, x:x+w]
#         roi = cv2.resize(roi, (200, 200))

#     return img, roi
BASE_DIR = os.path.dirname(os.path.abspath(__file__))
image_dir = os.path.join(BASE_DIR, "images")

for root, dirs, files in os.walk(image_dir):
    for file in files:
        if file.endswith("png") or file.endswith("jpg"):
            path = os.path.join(root, file)
            label = os.path.basename(root).replace(" ", "-").lower()

labels = {"person_name": 1}
with open("face-labels.pickle", 'rb') as f:
    og_labels = pickle.load(f)
    labels = {v: k for k, v in og_labels.items()}

while True:
    # capture frame by frame
    ret, frame = cap.read()
    gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
    faces = face_cascade.detectMultiScale(
        gray, scaleFactor=1.5, minNeighbors=5)

    for (x, y, w, h) in faces:
        # count = count+1
        # print(x, y, w, h)
        roi_gray = gray[y:y+h, x:x+w]
        roi_color = frame[y:y+h, x:x+w]

        # recognizing part

        # result = recognizer.predict(faces)
        id_, conf = recognizer.predict(faces)
        if conf >= 45 and conf <= 85:
            print(labels[id_])

        # print(conf)

        color = (255, 0, 0)  # BGR (blue green red)
        stroke = 2

        width = x+w
        height = y+h

        cv2.rectangle(frame, (x, y), (width, height), color, stroke)

        # img_item = "images/second/" + str(count) + ".png"
        # cv2.imwrite(img_item, roi_gray)
        # print(count)

    # frame
    cv2.imshow('frame', frame)
    if cv2.waitKey(1) == 13:
        break


cap.release()
cv2.destroyAllWindows()
