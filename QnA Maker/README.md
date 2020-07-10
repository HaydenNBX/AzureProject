# Create Chatbot with Azure Bot Server + QnA Maker

## Introduction
Azure Bot Service and Bot Framework provide tools to build, test, deploy, and manage intelligent bots all in one place. Through the use of modular and extensible framework provided by the SDK, tools, templates, and AI services developers can create bots that use speech, understand natural language, handle questions and answers, and more.

## Scenario
First we must first set up a QnA Maker service in Azure. Then create a new knowledge base with questions and answers from a public web-based FAQ. Save, train, and publish the knowledge base. Lastly, create a QnA chat bot from the Publish page for an existing knowledge base.


## Lab tutorial
### Create a QnA service in Microsoft Azure
1.1. Login to your Azure Portal account

1.2. Choose **Create a resource** at the left of the portal

1.3. Search for **Qna Maker**
<center><img src="./Images/001.png" alt="新增QnA Maker の resource" width="80%"></center>

1.4. Choose **Create**
<center><img src="./Images/002.png" alt="建立QnA Maker" width="80%"></center>

1.5. Fill in all the information that is required.

1.6. Choose **Create**
<center><img src="./Images/003.png" alt="填寫資訊" width="80%"></center>
<center><img src="./Images/004.png" alt="填寫資訊後建立" width="80%"></center>

1.7. There will show that the deployment is progress in the upper right corner of the portal.
<center><img src="./Images/005.png" alt="等他部署完成" width="80%"></center>

1.8. Until the deployment secceeded, choose **Go to resource**. It will show the QnA Maker console.
<center><img src="./Images/006.png" alt="Go to resource" width="80%"></center>
<center><img src="./Images/007.png" alt="看看就好的介面" width="80%"></center>

### Create Knowledge Base for QnA Maker
2.1. Use your Azure account, sign in to the [QnA Maker](https://www.qnamaker.ai/)

2.2. Choose **Create a knowledge base**.
<center><img src="./Images/008.png" alt="建立你的KB" width="80%"></center>

2.3. Since we already create the QnA service, so skip the first step.
<center><img src="./Images/009.png" alt="跳過第一步" width="80%"></center>

2.4. Step 2, choose your existing settings
<center><img src="./Images/010.jpg" alt="填資料" width="80%"></center>

2.5. Step 3, Name your Knowledge Base
<center><img src="./Images/011.jpg" alt="填資料" width="80%"></center>

2.6. Step 4, choose **Add fiel**, select **Test_KB** to upload.
<center><img src="./Images/012.png" alt="新增一個File" width="80%"></center>

2.7. Choose **None**.
<center><img src="./Images/013.png" alt="選none" width="80%"></center>

2.8. Step 5, choose **Create your KB**.
<center><img src="./Images/014.png" alt="建立你的KB" width="80%"></center>

2.9 Wait until the enviroment setting up.
<center><img src="./Images/015.png" alt="等他loading" width="80%"></center>

2.10. When the process done, you can choose **Test** to test your bot.

> You also can create a new QnA through choosing **Add QnA pair**.

> Remember to choose **Save and Train** if you have made any changes.
<center><img src="./Images/016.png" alt="測試" width="80%"></center>
<center><img src="./Images/017.png" alt="測試" width="80%"></center>

2.11. Choose **Publish**. Then choose **Publish** to publish your knowledge base.
<center><img src="./Images/018.png" alt="發布" width="80%"></center>
<center><img src="./Images/019.png" alt="發布" width="80%"></center>

2.12. Wai until the publishing done.
<center><img src="./Images/020.png" alt="loading" width="80%"></center>

2.13. Deploy success. **Don't close** this  page if you need it for future use.

2.14. Choose **Create Bot**, the Azure Portal will opens in new tab.
<center><img src="./Images/021.jpg" alt="準備建立web app bot" width="80%"></center>


### Create Web App Bot
3.1. Fill all the requirement.

    | Setting | Value |
    | -------- | -------- |
    | Bot handle |  Name yourself | 
    | Subscription |  Same subscription as you used to create QnA Maker |
    | Resource group |  Choose yourself | 
    | Location |  East Asia | 
    | Pricing tier |  F0 | 
    | App name |  Same with Bot handle | 
    | SDK |  C# | 
    | QnA Auth Key |  **Don't change** | 
    | App service plan/Location |  **Don't change** |
    | Azure Storage |  **Don't change** |
    | Application Insights |  **Don't change** |
    | Microsoft App ID |  **Don't change** |
3.2. Choose **Create**.
<center><img src="./Images/022.png" alt="填資料" width="80%"></center>
<center><img src="./Images/023.jpg" alt="填資料後建立" width="80%"></center>

3.3. Wait until the process done.
<center><img src="./Images/024.jpg" alt="等deploy好" width="80%"></center>

3.4. Deployment succeeded. Choose **Go to resource**.
<center><img src="./Images/025.png" alt="建好了去看看resource" width="80%"></center>

### Testing
4.1. Choose **Test in Web Chat**, try to get in touch with your Bot and see what it will reply.
<center><img src="./Images/026.png" alt="測試你的Bot" width="80%"></center>

### Clean Up
5.1. Check **Name**

5.2. Choose **Delete**.
<center><img src="./Images/027.png" alt="清理" width="80%"></center>

5.3. Type **yes** to confirm delete the resource you checked.

5.4. Choose **Delete**.
<center><img src="./Images/028.png" alt="清理" width="80%"></center>

### Reference
- [QnA Maker](https://docs.microsoft.com/en-us/azure/cognitive-services/qnamaker/)