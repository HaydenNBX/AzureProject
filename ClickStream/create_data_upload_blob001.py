from azure.storage.blob import BlockBlobService
from azure.storage.blob import ContentSettings
from azure.storage.blob import PublicAccess
import csv
import random
import time
import datetime
import os
path = '/Users/boxunng/Desktop/ClickStream/sample_data'
os.chdir(path)

# Blob 相關
mystoragename = "demousestorageaccount"
mystoragekey = "Mxl+xXXtuJ5Gx5V4h/MrpFKS+yVmM/vv0gW86fzLG5jz5jvtpBpZKrgq5SZpAqaU1GJ53OVePLnFTpT1eBVJpA=="
blob_service = BlockBlobService(account_name=mystoragename, account_key=mystoragekey)
#  blob_service.create_container('hayden')  //建立blob container

i = 3 # csv files start number, e.x. testing1.csv

for a in range(1):  #看你要產生幾個csv file
    with open('testing'+str(i)+'.csv', 'w', newline='') as file:
        writer = csv.writer(file)
        writer.writerow(["User_id", "Time", "Country","Category","Product"])
        
    for j in range(100): #每一個csv要幾筆資料
        timestamp = datetime.datetime.now()
        user = str(random.randint(1, 10000))
        country = random.choice(['United States', 'United Kindom', 'Taiwan', 'Canada', 'Australia', 'India', 'Japan', 'Philippines', 'Singapore', 'South Korea'])
        category = random.choice(['Blog', 'Community', 'Examples', 'Register', 'Search', 'Training'])
        product = random.choice(['Mobile', 'Computer','Tablet'])
        with open('testing'+str(i)+'.csv', 'a+', newline='') as file:
                writer = csv.writer(file)
                writer.writerow([user, timestamp, country, category,product])

    # 上傳blob用
    blob_service.create_blob_from_path(
        'blob001',   # 上面 create 的 blob container
        'testing'+str(i)+'.csv',    # blob container 上顯示的名字
        'testing'+str(i)+'.csv',    # local 端 的名字
        content_settings=ContentSettings(content_type='application/csv'))

    i += 1
    time.sleep(5)