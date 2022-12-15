import cv2
import numpy as np
import os
from PIL import Image
import pickle
from getpass import getpass

option = ""

while True:
    print("If YES: 1")
    print("if NO : 0")
    option = input("Enter your choice: ")
    option.strip()

    if option == "1":
        BASE_DIR = os.path.dirname(os.path.abspath(__file__))
        image_dir = os.path.join(BASE_DIR, "images")

        face_cascade = cv2.CascadeClassifier(
            'cascades/data/haarcascade_frontalface_alt2.xml')
        recognizer = cv2.face.LBPHFaceRecognizer_create()

        current_id = 0
        label_ids = {}
        y_labels = []
        x_train = []

        for root, dirs, files in os.walk(image_dir):
            for file in files:
                if file.endswith(".png") or file.endswith(".jpg"):
                    path = os.path.join(root, file)
                    label = os.path.basename(
                        root).replace(" ", "-").lower()
                    # print(label, path)
                    if not label in label_ids:
                        label_ids[label] = current_id
                        current_id += 1
                    id_ = label_ids[label]
                    print(label_ids)
                    # y_labels.append(label) # some number
                    # x_train.append(path) # verify this image, turn into a NUMPY arrray, GRAY
                    pil_image = Image.open(
                        path).convert("L")  # grayscale
                    size = (550, 550)
                    final_image = pil_image.resize(
                        size, Image.Resampling.LANCZOS)
                    image_array = np.array(final_image, "uint8")
                    # print(image_array)
                    faces = face_cascade.detectMultiScale(
                        image_array, scaleFactor=1.3, minNeighbors=5)

                    for (x, y, w, h) in faces:
                        roi = image_array[y:y+h, x:x+w]
                        x_train.append(roi)
                        y_labels.append(id_)

        print(y_labels)
        print(x_train)

        with open("face-labels.pickle", 'wb') as f:
            pickle.dump(label_ids, f)

        recognizer.train(x_train, np.array(y_labels))
        recognizer.save("face-trainner.yml")
        print("done")
        # -------------------------------------------------------
        # -------------------------------------------------------
        # -------------------------------------------------------
        # -------------------------------------------------------

        # face_cascade = cv2.CascadeClassifier(
        #     'cascades/data/haarcascade_frontalface_alt2.xml')
        # recognizer = cv2.face.LBPHFaceRecognizer_create()
        recognizer.read("face-trainner.yml")

        identification = ""

        labels = {"person_name": 1}
        with open("face-labels.pickle", 'rb') as f:
            og_labels = pickle.load(f)
            labels = {v: k for k, v in og_labels.items()}
        confidence = 0
        cap = cv2.VideoCapture(0)
        while True:
            ret, frame = cap.read()
            gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
            faces = face_cascade.detectMultiScale(
                gray, scaleFactor=1.3, minNeighbors=5)
            for (x, y, w, h) in faces:
                # print(x,y,w,h)
                roi_gray = gray[y:y+h, x:x+w]  # (ycord_start, ycord_end)
                roi_color = frame[y:y+h, x:x+w]

                id_, conf = recognizer.predict(roi_gray)
                confidence = conf
                print(confidence)
                if conf < 100 and conf > 72:
                    identification = labels[id_]
                    print(conf)
                else:
                    print("unknown " + str(conf))
                    break

                color = (255, 0, 0)  # BGR 0-255
                stroke = 2
                end_cord_x = x + w
                end_cord_y = y + h
                cv2.rectangle(frame, (x, y), (end_cord_x,
                              end_cord_y), color, stroke)
                print(identification)
                count_1 = 0
                if identification != "" and count_1 < 5:
                    count = count_1 + 1
                    break
            # -------------------------------------------------------
            # -------------------------------------------------------
            # -------------------------------------------------------
            # -------------------------------------------------------
            # -------------------------------------------------------
            # -------------------------------------------------------
            if confidence > 100 or confidence < 72:
                totalDir = 0
                id_no = 0
                for base, dirs, files in os.walk('images'):
                    print('Searching in : ', base)
                    for directories in dirs:
                        totalDir += 1
                id_no = totalDir + 1
                face_classifier = cv2.CascadeClassifier(
                    'cascades/data/haarcascade_frontalface_alt2.xml')

                def face_extractor(img):

                    gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
                    faces = face_classifier.detectMultiScale(gray, 1.5, 5)

                    if faces is ():
                        return None

                    for (x, y, w, h) in faces:
                        cropped_face = img[y:y+h, x:x+w]

                    return cropped_face

                cap = cv2.VideoCapture(0)
                count = 0
                # id_no = "Vidya_balan"

                directory = str(id_no)
                parent_dir = "images/"
                way = os.path.join(parent_dir, directory)
                mode = 0o666
                os.mkdir(way, mode)
                cmd = "chmod 777 images/" + str(id_no)
                os.system(cmd)

                while True:

                    ret, frame = cap.read()
                    if face_extractor(frame) is not None:
                        count += 1
                        face = cv2.resize(
                            face_extractor(frame), (200, 200))
                        face = cv2.cvtColor(face, cv2.COLOR_BGR2GRAY)

                        file_name_path = 'images/' + \
                            str(id_no) + '/'+str(count)+'.jpg'

                        cv2.imwrite(file_name_path, face)

                        cv2.putText(face, str(count), (50, 50),
                                    cv2.FONT_HERSHEY_COMPLEX, 1, (0, 255, 0), 2)
                        cv2.imshow('Face Cropper', face)
                    else:

                        print("Face not found")
                        pass

                    if cv2.waitKey(1) == 13 or count == 40:
                        break

                    print('Samples Colletion Completed ')
                    break

                cv2.imshow('frame', frame)
                break

            if cv2.waitKey(1) == 13 or identification != "":
                break

        # When everything done, release the capture
        cap.release()
        cv2.destroyAllWindows()
