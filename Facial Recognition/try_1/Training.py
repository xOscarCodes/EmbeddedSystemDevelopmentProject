# import cv2
# import numpy as np
# from os import listdir
# from os.path import isfile, join

# data_path = 'images/'
# onlyfiles = [f for f in listdir(data_path) if isfile(join(data_path,f))]

# Training_Data, Labels = [], []

# for i, files in enumerate(onlyfiles):
#     image_path = data_path + onlyfiles[i]
#     images = cv2.imread(image_path, cv2.IMREAD_GRAYSCALE)
#     Training_Data.append(np.asarray(images, dtype=np.uint8))
#     Labels.append(i)

# Labels = np.asarray(Labels, dtype=np.int32)

# model = cv2.face.LBPHFaceRecognizer_create()

# model.train(np.asarray(Training_Data), np.asarray(Labels))

# print("Dataset Model Training Completed ")


import cv2
import os
import numpy as np
from PIL import Image
import pickle

BASE_DIR = os.path.dirname(os.path.abspath(__file__))
image_dir = os.path.join(BASE_DIR, "images")

face_cascade = cv2.CascadeClassifier(
    'cascades/data/haarcascade_frontalface_alt2.xml')
recognizer = cv2.face.LBPHFaceRecognizer_create()

current_id = 0
label_ids = {}
y_labels = []
x_train = []

labels = {"person_name": 1}
with open("face-labels.pickle", 'rb') as f:
    og_labels = pickle.load(f)
    labels = {v: k for k, v in og_labels.items()}

for root, dirs, files in os.walk(image_dir):
    for file in files:
        if file.endswith("png") or file.endswith("jpg"):
            path = os.path.join(root, file)
            label = os.path.basename(root).replace(" ", "-").lower()
            print(label, path)
            if not label in label_ids:
                label_ids[label] = current_id
                current_id += 1
            id_ = label_ids[label]
            print(label_ids)
            # y_labels.append(label) # some number
            # x_train.append(path) # verify this image, turn into a NUMPY arrray, GRAY
            pil_image = Image.open(path).convert("L")  # grayscale
            size = (550, 550)
            final_image = pil_image.resize(size, Image.Resampling.LANCZOS)
            image_array = np.array(final_image, "uint8")
            print(image_array)
            faces = face_cascade.detectMultiScale(
                image_array, scaleFactor=1.5, minNeighbors=5)

            for (x, y, w, h) in faces:
                roi = image_array[y:y+h, x:x+w]
                x_train.append(roi)
                y_labels.append(id_)


# print(y_labels)
# print(x_train)

with open("face-labels.pickle", 'wb') as f:
    pickle.dump(label_ids, f)

recognizer.train(x_train, np.array(y_labels))
recognizer.save("face-trainner.yml")
