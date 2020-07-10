# Scale Set

## Scenario
Customers may access our application through a load balancer that distributed requests to one of the application instances. We let the applications distributed across multiple instances can provide redundancy and improve performance. Our customers must be distributed to another available applications instance if we have to perform maintenance of our services or update an applications instances. We need to increase the number of application instances that run our application, to keep up with additional customer demand.

## Lab tutorial
### Create Virtual Network
1.1. Login to your Azure Portal account

1.2. Choose **Create a resource** at the left of the portal

1.3. Search for **virtual network**
<center><img src="./Images/002-Searchresource.png" alt="新增VNet" width="80%"></center>

1.4. Choose **Virtual Network**
<center><img src="./Images/003-Choose Vnet.png" alt="選擇VNet" width="80%"></center>

1.5. Choose **Create**
<center><img src="./Images/004-Click Create.png" alt="點選create" width="80%"></center>

1.6. Fill in all the information that is required.

1.7. Choose **Create**
<center><img src="./Images/005-VnetInfo.png" alt="填寫資訊" width="80%"></center>


1.8. Until the deployment secceeded, choose **Go to resource**. 
<center><img src="./Images/006-DeploySuccess.png" alt="去看看你建立好的resource" width="80%"></center>

1.9. Choose **Address space**, confirm your address space is same as you config.
<center><img src="./Images/007-VnetAddressSpace.png" alt="檢查address space" width="80%"></center>

1.10. Choose **Subnets**, confirm your subnet information is same as you config.
<center><img src="./Images/008-VnetSubnet.png" alt="檢查Subnet" width="80%"></center>

### Create an SSH public-private key pair for Linux VMs in Azure
2.1. Open Terminal or cmd at your computer.

2.2. Create an SSH key pair
```
ssh-keygen -t rsa -b 2048
```

2.3. Display your public key with the following
```
cat ~/.ssh/id_rsa.pub
```

2.4. A typical public key value looks like this example:
```
ssh-rsa AAAAB3NzaC1yc2EAABADAQABAAACAQC1/KanayNr+Q7ogR5mKnGpKWRBQU7F3Jjhn7utdf7Z2iUFykaYx+MInSnT3XdnBRS8KhC0IP8ptbngIaNOWd6zM8hB6UrcRTlTpwk/SuGMw1Vb40xlEFphBkVEUgBolOoANIEXriAMvlDMZsgvnMFiQ12tD/u14cxy1WNEMAftey/vX3Fgp2vEq4zHXEliY/sFZLJUJzcRUI0MOfHXAuCjg/qyqqbIuTDFyfg8k0JTtyGFEMQhbXKcuP2yGx1uw0ice62LRzr8w0mszftXyMik1PnshRXbmE2xgINYg5xo/ra3mq2imwtOKJpfdtFoMiKhJmSNHBSkK7vFTeYgg0v2cQ2+vL38lcIFX4Oh+QCzvNF/AXoDVlQtVtSqfQxRVG79Zqio5p12gHFktlfV7reCBvVIhyxc2LlYUkrq4DHzkxNY5c9OGSHXSle9YsO3F1J5ip18f6gPq4xFmo6dVoJodZm9N0YMKCkZ4k1qJDESsJBk2ujDPmQQeMjJX3FnDXYYB182ZCGQzXfzlPDC29cWVgDZEXNHuYrOLmJTmYtLZ4WkdUhLLlt5XsdoKWqlWpbegyYtGZgeZNRtOOdN6ybOPJqmYFd2qRtb4sYPniGJDOGhx4VodXAjT09omhQJpE6wlZbRWDvKC55R2d/CSPHJscEiuudb+1SG2uA/oik/WQ== username@domainname
```

2.5. Copy your SSH key for future use.


### Create Virtual Machine Scale Set
3.1. Choose **Create a resource** at the left of the portal

3.2. Search for **virtual machine scale set**
<center><img src="./Images/010-Search resource.png" alt="CreateResource" width="80%"></center> 

3.3. Choose **Virtual machine scale set**
<center><img src="./Images/011-Choose ScaleSet.png" alt="選擇ScaleSet" width="80%"></center>

3.4. Choose **Create**
<center><img src="./Images/012-Click Create.png" alt="點選Create" width="80%"></center>

3.5. Fill in all the information that is required. Remember to paste the code below to **Cloud init** section.
```
#cloud-config
runcmd:
 - sudo apt-get update -y
 - sudo apt-get install apache2 -y
 - sudo wget https://raw.githubusercontent.com/JamesHsu333/ScaleSet/master/3.Build_Static_Website_with_Azure_VM_Scale_Set/index.html
 - sudo rm /var/www/html/index.html
 - sudo mv index.html /var/www/html/
 - sudo systemctl start apache2.service
 - sudo systemctl enable apache2.service
```

<center><img src="./Images/013-ScaleSetInfo.png" alt="ScaleSet資訊" width="80%"></center>
<center><img src="./Images/015-ScaleSetInfo.png" alt="ScaleSet資訊" width="80%"></center>
<center><img src="./Images/016-ScaleSetInfo.png" alt="ScaleSet資訊" width="80%"></center>
<center><img src="./Images/017-ScaleSetInfo.png" alt="ScaleSet資訊" width="80%"></center>
<center><img src="./Images/018-ScaleSetInfo.png" alt="ScaleSet資訊" width="80%"></center>
<center><img src="./Images/019-ScaleSetInfo.png" alt="ScaleSet資訊" width="80%"></center>

3.6. There will show that the deployment is progress in the upper right corner of the portal.
<center><img src="./Images/020-DeploymentProcess.jpg" alt="DeploymentProcess" width="80%"></center>

3.7. Until the deployment secceeded, choose **Go to resource**. 
<center><img src="./Images/021-DeploySuccess.jpg" alt="DeploySuccess" width="80%"></center>


3.8. Choose **Instances**, there's several virtual machine already existed.
<center><img src="./Images/022-ViewInstances.png" alt="ViewInstances" width="80%"></center>

3.9. Choose **Scaling**, swap down to **Default** section, take a look of your configuration.
<center><img src="./Images/023-Scaling.png" alt="Scaling" width="80%"></center>

3.10. Choose **(Average)Percentage CPU > 50** rule.
<center><img src="./Images/024-ChooseScaleOut.png" alt="ChooseScaleOut" width="80%"></center>

3.11. Change the **Operator** to **Greater than or equal to**.
<center><img src="./Images/026-ScaleRule.png" alt="ScaleRule" width="80%"></center>

3.12. Choose **(Average)Percentage CPU < 25** rule.
<center><img src="./Images/027-ChooseScaleIn.png" alt="ChooseScaleIn" width="80%"></center>

3.13. Change the **Operator** to **Less than or equal to**.
<center><img src="./Images/028-ScaleRule.png" alt="ScaleRule" width="80%"></center>

3.14. Let your rules as below:
<center><img src="./Images/029-ScaleRuleConfirm.png" alt="ScaleRuleConfirm" width="80%"></center>


### Connect to Linux Virtual Machine
4.1. Choose **Instances** and one of your running virtual machine.
<center><img src="./Images/030-ChooseVM.png" alt="ChooseVM" width="80%"></center>

4.2. At **Overview** blade.

4.3. choose **Connect**.

4.4. Copy **Local using VM local account**.
<center><img src="./Images/031-DownloadRDP.png" alt="copyssh" width="80%"></center>

4.5. Open your terminal or cmd, paste **Local using VM local account** on terminal.

4.6. Enter **yes** to continue.

4.7. Enter your **passphare key**.
<center><img src="./Images/032.png" alt="copyssh" width="80%"></center>

4.8. Run the code below:
```
sudo apt-get update
```
```
sudo apt-get install stress
```
```
stress --version
```
<center><img src="./Images/033.png" alt="copyssh" width="80%"></center>
<center><img src="./Images/034.png" alt="copyssh" width="80%"></center>



4.9. Enter the command below to make CPU become Stress.
```
stress -c 4
```
<center><img src="./Images/035.png" alt="copyssh" width="80%"></center>

4.10. After a few minute, cause the loading became more and more, we can see that a few virtual machines were created.
<center><img src="./Images/036.png" alt="copyssh" width="80%"></center>

4.11. Let enter **control+c** stop the command **stress -c 4**, let cpu utilization become low.

4.12 After a few minutes, take a look of your instances, they should be delete automatically because the CPU Utilization is low now.







### Clean up
5.1. Check the **Name** for choosing all the resource that we've create.
5.2. Choose **Delete**.
<center><img src="./Images/051-DeleteResource.png" alt="DeleteResource" width="80%"></center>

5.3. Input **yes** to confirm delete.
<center><img src="./Images/052-CleanUp.png" alt="CleanUp" width="80%"></center>

### Reference
- [Virtual Machine Scale Sets](https://docs.microsoft.com/en-us/azure/virtual-machine-scale-sets/overview)

