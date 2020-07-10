# Implement for 3-tier architecture

## What We're Going to Do
<center><img src="Images/Picture1.png" alt="001:去自己的resource group" width="95%"></center>


A three-tier architecture is a client-server architecture in which the functional process logic, data access, computer data storage and user interface are developed and maintained as independent modules on separate platforms. Three-tier architecture is a software design pattern and a well-established software architecture.
### What does it do?
- This application structure makes it easier to handle spikes of traffic to scale
- It gives you Microsoft's 99.95% SLA for virtual machines
- Considered a high-availability architecture, although there are still some single point of failure with the region and the load balancer.

### See What We Will Create Together
- Public load balancer
- 2 Windows virtual machines(created by Azure portal and PowerShell)
- Internal load balancer
- 2 Linux virtual machines(created by Azure portal and CLI)
- Azure SQL Database(with failover configuration to another region)
---
## Create Virtual Machines and Load Balancers
### Create Our First Windows VM using the Azure Portal
- Choose **Resource groups** at the left of the panel and choose your resource group.
- If you don't have any resource group, just choose **Add** to create one.
<center><img src="Images/001.jpg" alt="001:去自己的resource group" width="95%"></center>

- Choose **Add** to  create a new resource in your resource group.
<center><img src="Images/002.png" alt="002:新增一個resource" width="95%"></center>

- Type **windows server** at the search bar.
- Choose **Windows Server**.
<center><img src="Images/003.png" alt="003:搜尋相關產品" width="95%"></center>

- Choose **Windows Server 2016 Datacenter**
- Choose **Create**
<center><img src="Images/004.png" alt="004:選擇相對應的版本並建立" width="95%"></center>

- At the **Basic** section, any required must be choose or create.
<center><img src="Images/005.png" alt="005:新增一個resource" width="95%"></center>
<center><img src="Images/006.png" alt="006:新增一個resource" width="95%"></center>
<center><img src="Images/007.png" alt="007:新增一個resource" width="95%"></center>
<center><img src="Images/008.png" alt="008:新增一個resource" width="95%"></center>
<center><img src="Images/009.png" alt="009:新增一個resource" width="95%"></center>

- At **Disk** section, select **Standard HDD**
<center><img src="Images/010.png" alt="010:Disks選HDD，只是為了省錢" width="95%"></center>

- At **Networking** section, virtual network & subnet & Public IP will created automatically. 
<center><img src="Images/011.jpg" alt="011:選Vnet等設定" width="95%"></center>
<center><img src="Images/012.png" alt="012:其他設定" width="95%"></center>

- At **Management** section, you can turn on anything you want. At here, we choose **Off** for everything.
<center><img src="Images/013.png" alt="013:全部選Off啦" width="95%"></center>

- At **Advanced** section, choose **Next**.
<center><img src="Images/014.png" alt="014:直接Next" width="95%"></center>

- At **Tags** section, choose the **Name** and **Value** if you have, then **Next**.
<center><img src="Images/015.png" alt="015:直接Next" width="95%"></center>

- At **Review + create** section, make sure your Valid is passed.
- Please **download a template for automation** for future use.
- Last, choose **Create**
<center><img src="Images/016.png" alt="016:點選下載template" width="95%"></center>
<center><img src="Images/017.png" alt="017:下載後關閉" width="95%"></center>
<center><img src="Images/018.png" alt="018:按下create" width="95%"></center>

### Create Another Windows VM Using ARM Templates and PowerShell
- Open the files in the previous downloaded folder, we'll modify some value in **parameters.json**.
<center><img src="Images/019.jpg" alt="019:按下create" width="95%"></center>

- We need to change the name or value of **networkInterfaceName** + **publicIPAddressName** + **virtualMachineName** + **adminPassword** before deploy to Azure.
<center><img src="Images/020.png" alt="020:按下create" width="95%"></center>
<center><img src="Images/021.png" alt="021:按下create" width="95%"></center>
<center><img src="Images/022.png" alt="022:按下create" width="95%"></center>
<center><img src="Images/023.png" alt="023:按下create" width="95%"></center>

- Open **Windows Power Shell**
<center><img src="Images/025.png" alt="025:按下create" width="95%"></center>

- Go to the template's folder directory, Type **dir** command to show what we have in the folder.
- <pre><code>Set -ExecutionPolicy -Scope Process -ExecutionPolicy Bypass</code></pre>
- Type Y for any questions.
<center><img src="Images/026.png" alt="026:按下create" width="95%"></center>

- <pre><code>./deploy</code></pre>
- Fill your Subscription ID & ResourceGroupName.
- Login to your Azure account on the panel.
<center><img src="Images/027.png" alt="027:按下create" width="95%"></center>

- After login to your Azure account, it'll show **Starting deployment**
- Wait until the deplotment success.
<center><img src="Images/028.png" alt="028:powershell畫面" width="95%"></center>
<center><img src="Images/029.png" alt="029:powershell畫面" width="95%"></center>

- After the deploy success, check out the resource you've create in your resource group. 
<center><img src="Images/030.png" alt="030:去RG檢查" width="95%"></center>

### Create Both of the Load Balancers
At this part, we'll create two load banlancer(one for Public and another for Internal use). So firstly, let us create the Public Load Balancer.
- Choose **+Add** to create a resource inside your resource group.
<center><img src="Images/031.png" alt="031:按下Add" width="95%"></center>

- Type **load balancer** at the search bar.
- Choose **Load Balancer**.
<center><img src="Images/032.png" alt="032:搜尋並選擇loadbalance" width="95%"></center>

- Choose **Create** to create load balancer 
<center><img src="Images/033.png" alt="033:按下create" width="95%"></center>

- Fill in all the requirement, make sure you have choose the type of load balancer as **Public**.
- Choose **Next:Tags**
<center><img src="Images/034.png" alt="034:按下create" width="95%"></center>

- At **Tags** section, choose the **Name** and **Value** if you have, then **Next:Review + create**.
<center><img src="Images/035.png" alt="035:按下create" width="95%"></center>

- Wait the page showing **Validation passed** before creating this load balancer.
<center><img src="Images/038.png" alt="038:按下create" width="95%"></center>
To create a Internal Load Balancer, just following the same step with how you create Public Load Balancer. The only things you need to change is the type of load balancer need to be "Internal".

- After create all the load balancer, we need to configure the **Backend pools** to each load balancer
- Choose your public load balancer in your resource group.
<center><img src="Images/039.png" alt="039:按下create" width="95%"></center>

- Choose **Backend pool**, then choose **+Add**
<center><img src="Images/040.png" alt="040:按下create" width="95%"></center>

- Fill in all the requirement, we'll need to configure this load balancer associated to Availability  Set beacause two of the windows virtaul machines are in one availability set.
- Choose **OK** if done.
<center><img src="Images/041.png" alt="041:按下create" width="95%"></center>

- When it's done, we can see the result on the panel.
<center><img src="Images/042.png" alt="042:按下create" width="95%"></center>


### Create Our First Linux VM using the Azure Portal
- At your resource group, add a resource through a marketplace
- Type **ubuntu** at the search bar and choose **Ubuntu Server 18.04 LTS**
<center><img src="Images/043.png" alt="043:按下create" width="95%"></center>

- Choose **Create**
<center><img src="Images/044.png" alt="044:按下create" width="95%"></center>

- At **Basic** section, fill in all the requirements.
- Same with create windows virtual machines, also create an availability set for Ubuntu virtual machines.
- Size of ubunutu vm : **Standard B1ms**
<center><img src="Images/045.png" alt="045:按下create" width="95%"></center>

- We'll would like to use ssh connect to ubuntu vm, it's required a public key to access, so let's create our own key.
- Copy your public key for later use.
<center><img src="Images/046.png" alt="046:按下create" width="95%"></center>

- Back to **Basic** section, choose **SSH public key**, type in the name you used to login to your vm and paste the public key that we create just now.
- Allowed SSH inbound ports.
- Choose **Next:Disks**.
<center><img src="Images/047.png" alt="047:按下create" width="95%"></center>

- At **Disk** section, **Standard HDD** for OS disk type.
<center><img src="Images/048.png" alt="048:按下create" width="95%"></center>

- At **Networking** section, fill in the requirement.
- Make sure that ubuntu vm don't need a public ip, because we don't want anyone can access to this tier through public ip.
<center><img src="Images/049.png" alt="049:按下create" width="95%"></center>

- At **Management** section, you can turn on anything you want. At here, we choose **Off** for everything.
<center><img src="Images/050.png" alt="050:按下create" width="95%"></center>

- At **Tags** section, choose the **Name** and **Value** if you have, then **Next:Review + create**.
<center><img src="Images/051.png" alt="051:按下create" width="95%"></center>

- At **Review + create** section, make sure your Valid is passed.
- **Download a template for automation** before you create the first machine.
<center><img src="Images/052.png" alt="052:按下create" width="95%"></center>
<center><img src="Images/053.png" alt="053:按下create" width="95%"></center>

### Create Another Linux VM Using Bash Scripts / Cloud Shell
- Open the files in the previous downloaded folder, we'll modify some value in **parameters.json**.
- We need to change the name or value of **networkInterfaceName** + **virtualMachineName** + **adminPublickey** before deploy to Azure.
<center><img src="Images/054.png" alt="054:按下create" width="95%"></center>
<center><img src="Images/055.png" alt="055:按下create" width="95%"></center>
<center><img src="Images/056.png" alt="056:按下create" width="95%"></center>

- Choose Cloud shell on the top of the portal. It will show out a terminal at the bottom.
- Choose **Create storage**
<center><img src="Images/cloudshell.png" alt="cloudshell:按下create" width="95%"></center>
<center><img src="Images/058.png" alt="058:按下create" width="95%"></center>

- Wait until the initiallize complete, enter "ls -a" in your terminal to check out what you have in this directory.
<center><img src="Images/059.png" alt="059:按下create" width="95%"></center>

- We would like to use terminal to deploy our second ubuntu virtual machine. Because we don't have any files that we need to use, so let upload some files.
<center><img src="Images/060.png" alt="060:按下create" width="95%"></center>
<center><img src="Images/061.png" alt="061:按下create" width="95%"></center>
<center><img src="Images/062.png" alt="062:按下create" width="95%"></center>

- there's some command that we need to use:
<pre><code>chmod +x deploy.sh</code></pre>
<pre><code>sed -i -e 's/\r$//' deploy.sh</code></pre>
<pre><code>sed -i -e 's/\r$//' template.json</code></pre>
<pre><code>sed -i -e 's/\r$//' parameters.json</code></pre>
<pre><code>./deploy.sh</code></pre>

- We'll asked to enter **Subscription ID** + **Resource group name** + **name of deployment** + **resource group location** before running the deployment process.
- It'll show **Template has been successfully deployment** when the deploy seccess.
<center><img src="Images/063.png" alt="063:按下create" width="95%"></center>
<center><img src="Images/064.png" alt="064:按下create" width="95%"></center>

- Last step of this part, remember config the backend pool of the Internal
- At your resource group, choose your Internal Load Balancer and seclect **Backend pools** and **Add**
- Fill in all the requirement, we'll need to configure this load balancer associated to Availability Set beacause two of the windows virtaul machines are in one availability set.
- Choose **OK** and see the result.
<center><img src="Images/066.png" alt="067:按下create" width="95%"></center>
<center><img src="Images/067.png" alt="067:按下create" width="95%"></center>
<center><img src="Images/068.png" alt="068:按下create" width="95%"></center>

---
## Create Databases

### Create Our SQL Database
- Choose **+Add** to add a resource into you resource group.
<center><img src="Images/069.png" alt="069:按下create" width="95%"></center>

- Type **sql database** at the search bar and choose **SQL Database**.
<center><img src="Images/070.png" alt="070:按下create" width="95%"></center>

- Choose **Create**
<center><img src="Images/071.png" alt="071:按下create" width="95%"></center>

- Fill in the require blank, creat a new server for this database.
<center><img src="Images/072.png" alt="072:按下create" width="95%"></center>

- Choose **Basic** and **Apply**
<center><img src="Images/073.png" alt="073:按下create" width="95%"></center>

- At **Tags** section, choose the **Name** and **Value** if you have, then **Next**.
<center><img src="Images/074.png" alt="074:按下create" width="95%"></center>

- Choose **Create**
<center><img src="Images/075.png" alt="075:按下create" width="95%"></center>


### Set Up Automatic Failover to a SecondaryRegion
- After the deployment is complete, choose **Go to resource**
<center><img src="Images/076.png" alt="076:按下create" width="95%"></center>

- Choose **Geo-Replication**, then select **SouthastAsia** as our secondary database.
<center><img src="Images/077.png" alt="077:按下create" width="95%"></center>

- Create target server for the secondary database and choose **Basic** for the Pricing Tier
<center><img src="Images/078.png" alt="078:按下create" width="95%"></center>
<center><img src="Images/079.png" alt="079:按下create" width="95%"></center>

- Wait until the Status become **Readble**
<center><img src="Images/080.png" alt="080:按下create" width="95%"></center>

- Scroll the page to the top, choose the pop-up bar to create a failover group.
<center><img src="Images/081.png" alt="081:按下create" width="95%"></center>

- Finished all the requirement then choose **Create**.
<center><img src="Images/082.png" alt="082:按下create" width="95%"></center>



---
## Clean Up and Testing
### Install IIS Web Server on the Windows Virtual Machines
In this part, we'll install IIS web server on the windows vm, this step should be done to the second front end server and install a web server there as well.
- Choose the one of your Windows VM 
<center><img src="Images/083.png" alt="083:按下create" width="95%"></center>

- Choose **Connect** and **Download RDP file**, Click on the file that you've download.
<center><img src="Images/084.png" alt="084:按下create" width="95%"></center>

- Choose **Connect** and fill in your information to login to the windows vm
<center><img src="Images/085.png" alt="085:按下create" width="95%"></center>
<center><img src="Images/086.png" alt="086:按下create" width="95%"></center>

- Choose **Yes**.
<center><img src="Images/087.png" alt="087:按下create" width="95%"></center>

- After login to the computer, Server Manager will show up automatically.
- Choose **Add roles and features**
<center><img src="Images/088.png" alt="088:按下create" width="95%"></center>

- For server roles, choose **Web Server(IIS)**
- **Add features** for the pop out windows.
- Choose **Next**
<center><img src="Images/089.png" alt="089:按下create" width="95%"></center>
<center><img src="Images/090.png" alt="090:按下create" width="95%"></center>
<center><img src="Images/091.png" alt="091:按下create" width="95%"></center>

- For features, select **ASP.NET4.6**
- Choose **Next**.
<center><img src="Images/092.png" alt="092:按下create" width="95%"></center>

- For confirmation, choose **Install**.
<center><img src="Images/093.png" alt="093:按下create" width="95%"></center>

:::warning 
⚠️Remember to install web server for the second windows vm.
:::

### Configure Front-End Load Balancer for Public Traffic
- Choose public IP address of the public load balancer
<center><img src="Images/094.png" alt="094:按下create" width="95%"></center>

- Choose **Configuration**
- Type in **DNS name label**
- Choose **Save**
<center><img src="Images/095.png" alt="095:按下create" width="95%"></center>

- Choose the Public Load Banlancer in your resource group.
<center><img src="Images/096.png" alt="096:按下create" width="95%"></center>

- Choose **Health prob** and **+Add**
<center><img src="Images/097.png" alt="097:按下create" width="95%"></center>

- Fill in the requirement and choose **OK**
<center><img src="Images/098.png" alt="098:按下create" width="95%"></center>

- Choose the windows vm's network security group in your resource group.
<center><img src="Images/099.png" alt="099:按下create" width="95%"></center>

- Choose **Inbound security rules**. We've already add 80, 22, 3389 port.
- We need to add a new rules for port 443. Choose **+Add**
- Fill in all the information that needed.
<center><img src="Images/100.png" alt="100:按下create" width="95%"></center>

- Back to your Public Load Balancer, choose **Load balancing rules** and **Add**.
<center><img src="Images/101.png" alt="101:按下create" width="95%"></center>

- Fill in the requirement and choose **OK**
<center><img src="Images/102.png" alt="102:按下create" width="95%"></center>









### Configure Back-End Load Balancer for Internal Traffic
- Choose the Public Load Banlancer in your resource group.
<center><img src="Images/103.png" alt="103:按下create" width="95%"></center>

- Choose **Health prob** and **+Add**
<center><img src="Images/104.png" alt="104:按下create" width="95%"></center>

- Fill in the requirement and choose **OK**
<center><img src="Images/105.png" alt="105:按下create" width="95%"></center>

- Choose **Load balancing rules** and **Add**.
<center><img src="Images/106.png" alt="106:按下create" width="95%"></center>

- Fill in the requirement and choose **OK**
<center><img src="Images/107.png" alt="107:按下create" width="95%"></center>

### Testing
- Choose public IP address of the public load balancer
<center><img src="Images/109.png" alt="109:按下create" width="95%"></center>

- Copy the DNS name, and paste it to chrome, it'll show as below
<center><img src="Images/110.png" alt="110:按下create" width="95%"></center>
<center><img src="Images/111.png" alt="111:按下create" width="95%"></center>

### Clean
- At your resource group, select **Name** to choose all the resource that you create.
- Choose **Delete** at the upper right corner.
- For confirm delete, type **yes** to confirm delete
- Lastly, choose **Delete**.
<center><img src="Images/112.png" alt="112:按下create" width="95%"></center>

