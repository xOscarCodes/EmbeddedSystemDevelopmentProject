import cv2
import numpy as np
import os
from PIL import Image
import pickle
from getpass import getpass
import time
import pymysql




while True:
    # option ="(0,)"
    conn = pymysql.connect(host='localhost', user='root',password='seesproject', db='payment')

    a = conn.cursor()
    sql = "SELECT Approval FROM pi_to_html"
    delete = "TRUNCATE TABLE pi_to_html"
    a.execute(sql)
    
    option = str(a.fetchone())
    # print(option)
    # print(option)

    # option = ""

    send_id = ''

    done = False

    if(option == "(1,)" or option ==  "(0,)"):
        a.execute(delete)

    


    # print("If YES: 1")
    # print("if NO : 0")
    # option = input("Enter your choice: ")
    # option.strip()

    if option == "(1,)":
        # pehle train, phir find, check karo ki banda hai ki nahin, agar nahin hai to add the data.

        face_cascade = cv2.CascadeClassifier(
            'cascades/data/haarcascade_frontalface_alt2.xml')

        BASE_DIR = os.path.dirname(os.path.abspath(__file__))
        image_dir = os.path.join(BASE_DIR, "images")

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
                    # print(label_ids)
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

        # print(y_labels)
        # print(x_train)

        with open("face-labels.pickle", 'wb') as f:
            pickle.dump(label_ids, f)

        recognizer.train(x_train, np.array(y_labels))
        recognizer.save("face-trainner.yml")
        print("done")
        unknown_counter = 0
        print("Now checking if the person is added to the database")

        # face recognition

        recognizer.read("face-trainner.yml")
        identification = ""

        labels = {"person_name": 1}
        with open("face-labels.pickle", 'rb') as f:
            og_labels = pickle.load(f)
            labels = {v: k for k, v in og_labels.items()}

        cap = cv2.VideoCapture(0)
        time.sleep(2)
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
                if conf < 100 and conf > 70:
                    identification = labels[id_]
                    send_id = labels[id_]
                    # print()
                    print(conf)
                else:
                    print("unknown" + str(conf))
                    unknown_counter = unknown_counter + 1
                    print(unknown_counter)
                    pass
    # ---------------------------------------------------
    # ---------------------------------------------------
                if unknown_counter >= 30 and done != True:

                    done = True
                    totalDir = 0
                    id_no = 0
                    for base, dirs, files in os.walk('images'):
                        print('Searching in : ', base)
                        for directories in dirs:
                            totalDir += 1
                    id_no = totalDir + 1
                    send_id = id_no
                    # cap_1 = cv2.VideoCapture(1)

                    directory = str(id_no)
                    parent_dir = "images/"
                    way = os.path.join(parent_dir, directory)
                    mode = 0o666
                    os.mkdir(way, mode)
                    cmd = "chmod 777 images/" + str(id_no)
                    os.system(cmd)

                    count = 0

                    def face_extractor(img):

                        gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
                        faces = face_cascade.detectMultiScale(gray, 1.5, 5)

                        if faces is ():
                            return None

                        for (x, y, w, h) in faces:
                            cropped_face = img[y:y+h, x:x+w]

                        return cropped_face
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

                        if cv2.waitKey(1) == 13 or count == 20:
                            break
                # if done == True:
                #     break
                color = (255, 0, 0)  # BGR 0-255
                stroke = 2
                end_cord_x = x + w
                end_cord_y = y + h
                cv2.rectangle(frame, (x, y), (end_cord_x,
                                            end_cord_y), color, stroke)
                print(identification)
                if identification != "" or done == True:
                    break

            cv2.imshow('frame', frame)
            if cv2.waitKey(1) == 13 or identification != "" or done == True:
                break
        cap.release()
        cv2.destroyAllWindows()

        insert = f"INSERT INTO pi_to_html (Customer_ID, refreshen) VALUES ({send_id}, '1')"
        a.execute(insert)
        conn.commit()
    # else:
        print(str(send_id) + "..")