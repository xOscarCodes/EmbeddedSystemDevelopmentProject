import pyrebase

firebaseConfig = {
  "apiKey": "AIzaSyBpzOeL_5S3UytuAt0SD3MjNFk_IZ3baf0",
  "authDomain": "practice-48e2c.firebaseapp.com",
  "databaseURL": "https://practice-48e2c-default-rtdb.asia-southeast1.firebasedatabase.app",
  "projectId": "practice-48e2c",
  "storageBucket": "practice-48e2c.appspot.com",
  "messagingSenderId": "961705676039",
  "appId": "1:961705676039:web:c599b60c39445d820849a2"
  }

firebase = pyrebase.initialize_app(firebaseConfig)

# setting up storage

storage = firebase.storage()

# file = input("enter the name of file you want to upload to storage")
# cloudfilename = input("enter the name for the file in storage")

storage.child("ID.txt").put("ID.txt")   # enter the nmae of file

# #get url
# print(storage.child(cloudfilename).get_url(None))

# #download
# downloadlink = input("Enter download url")
# storage.child(downloadlink).download("\enter the file name/")

# #read from a file
# path = input("Enter the path in storage of the file you want to read")
# url = print(storage.child(path).get_url(None))
# f = urllib.request.urlopen(url).read(None)

# # use write() to write a word and writelines to write a line in file and update using file = open('filename', 'a')
# print(f)
