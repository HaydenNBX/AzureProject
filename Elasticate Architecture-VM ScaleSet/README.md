# Elastic your Architecture

## Overview
[Azure virtual machine scale sets](https://docs.microsoft.com/en-us/azure/virtual-machine-scale-sets/overview) can create and manage a group of identical, load balanced VMs,The number of VM instances can **automatically increase or decrease** in response to demand or a defined schedule.With virtual machine scale sets, Can build **large-scale** services for areas such as compute, big data, and container workloads.

[Azure Load Balancer](https://docs.microsoft.com/en-us/azure/load-balancer/load-balancer-overview) supports **inbound** and **outbound** scenarios, provides **low latency** and **high throughput**, and scales up to millions of flows for all **TCP and UDP** applications.

When there's huge or unstable traffic, you can use load balancer to distributes incoming traffic, and setup Auto scaling to generate enough instances to handle the traffic.

<p align="center">
    <img src="Images/032-Scale Set.png" width="80%" height="80%">

## Scenario
The following procedures help you set up a scaled and load-balanced application, you will start with **Azure Azure virtual machine scale sets** in Portal which automatically deploy **Load Balancer** and **Virtual Machine** Then you will have to finish  **Virtual Network** by your own

## Step by step 
### Deploy your Vnet environment.
A virtual network is the fundamental building block for your private network in Azure. It enables Azure resources, like virtual machines (VMs), to securely communicate with each other and with the internet


1. On the  Azure Portal , Select **Virtual networks**
<p align="center">
    <img src="Images/001-Azure console.png" width="80%" height="80%">

2. Select **Add**
<p align="center">
    <img src="Images/002-V-net.png" width="80%" height="˙80%">

3. Input the followings then select Create and Close:

    * Name :  `ecloudture- your Name -net`
    * Address space :  `10.1.0.0/16`
    * Subscription : Select `your Subscriptions`.
    * Resource Group : Select `your Resource Group` 
    * Location :  `East US`
    * Subnet Name : `ecloudture- your Name -Subnet`
    * Subnet Address range :  `10.1.0.0/24`
    * DDOS protection : `Basic`
    * Server Endpoints : `Disable`
    * FireWall : `Disable`
<p align="center">
    <img src="Images/003-Create V-net.png" width="80%" height="80%">

4. Leave the rest as default and select **Create**

### Create Virtual Machine Scale Set
You can deploy a scale set with a Windows Server image or Linux image such as RHEL, CentOS, Ubuntu, or SLES.

1. Search for **Scale set**, choose **Virtual machine scale set**
<p align="center">
    <img src="Images/004-Search Scale Set.png" width="80%" height="80%">

2. Select `Create`
<p align="center">
    <img src="Images/005-CreateVM Scale Set.png" width="80%" height="80%">

3. Input the followings
    

     * Virtual Machine Scale Set :  `Your Name`
     * Operating system disk image :  `Window Server 2016 Datacenter`
     * Subscription : `Your Subscription`
     * Resource group : `Your Resource group`
     * Location : `East US`
     * Username : `Your Name`
     * Password : `Your password`
     * Confirm Password:**Enter** `Your password`again
<p align="center">
    <img src="Images/006-Scale Set.png" width="80%" height="80%">

4. Setting Instance Count and Size

    * Instance Count:Enter : `2`
    * Instance Size : **Change Size** `Standard B1S`
    * Disploy as low Priority : `No`
    * Use managed disk : `Yes`
<p align="center">
    <img src="Images/007-VM Iinstance.png" width="80%" height="80%">

 5. Setting AutoScale rule
    
     Autoscale : `Enabled` 
    * Minmum number : `1`
    * Maximum number : `4`
    
    Scale out
    * CPU threshold(%) : `75`
    * Number of VMS to increase by : `1`

    Scale in 
    
    * CPU threshold(%) : `25`
    * Number of VMS to decrease by : `1`
    <p align="center">
    <img src="Images/008-autoScaling.png" width="80%" height="80%">

  6. Setting Networking

     * Choose Load Balancing options : **Select**` Load balancer`
    
     * Public IP adress name : `Your name address`
     * Domain name label : `Your name domainname`

     Configure Virtual network

     * Virtual network : Select `Your virtual network`
     * Subsent : `Your Subsent `
     * Pubilc IP address per instance : `Off`
     * Public inbound Ports:`Allow selected ports`
        
        * Select inbound Ports:`RDP`,`HTTP`
<p align="center">
    <img src="Images/009-Scale set network.png" width="80%" height="80%">


   7. Setting Management
      
      * Boot diagnostics : `Off`
      * System assigned managed identity : `Off`

8. Select : **Create**

### Configured auto scaling Instance limits and **Scale Rule**
   
1. From the list of vitural machine Scale set, select **Scaling**
<p align="center">
    <img src="Images/011-Configure Scaling.png" width="80%" height="80%">

    
2. On Configure,Choose how to scale your resource : Select`Custom autoscale`
<p align="center">
    <img src="Images/010-Scaling.png" width="80%" height="80%">

3. On Default Profile1,Scale Mode : Select`Scale based on a metric`
<p align="center">
    <img src="Images/012-Scale mode.png" width="80%" height="80%">

4. Choose **Scale Out** ,you can see **Scale rule** window

<p align="center">
    <img src="Images/013-Rule.png" width="80%" height="80%">

5. Check **Scale Rule**
        
    * Time aggregation :  `Average`
    * Metric namespace : `Virtual Machine Host`
    * Matric name : `Percentage CPU`
    * Time grain statistic : `Average`
    * Operator : `Greater then`
    * Threshold : `75`
    * Duration : `5`
<p align="center">
    <img src="Images/014-Scale rule.png" width="80%" height="80%">

 <p align="center">
    <img src="Images/015-Scale rule.png" width="80%" height="80%">
   
 On Action
        
* Operation : `Increase count  by`
* Instance Count : `1`
* Cool down(minutes) : `1`
    
Select  **update**  
    
6. Choose **Scale in** ,you can see **Scale rule** window
<p align="center">
    <img src="Images/016-Scale rule.png" width="80%" height="80%">
   

7. Check **Scale Rule**
    
    * Time aggregation :  `Average`
    * Metric namespace : `Virtual Machine Host`
    * Matric name : `Percentage CPU`
    * Time grain statistic : `Average`
    * Operator : `Less then`
    * Threshold : `25`
    * Duration : `5`
<p align="center">
    <img src="Images/017-Scale rule.png" width="80%" height="80%">
<p align="center">
    <img src="Images/018-Scale rule.png" width="80%" height="80%">
   
   
On Action    
    
* Operation : `Decrease count by`
* Instance Count : `1`
* Cool down(minutes) : `1`
     
Select  **update**  
<p align="center">
    <img src="Images/019-Scale rule.png" width="80%" height="80%">
   
### Connect to a VM in the scale set
When you create a scale set in the portal, a load balancer is created. Network Address Translation (NAT) rules are used to distribute traffic to the scale set instances for remote connectivity such as RDP or SSH.

* For a Windows scale set, connect to the VM instance with RDP on`Your address:your TCP Port`
* For a Linux scale set, connect to the VM instance with SSH on `ssh azureuser@Your address  -p your TCP Port`


3. Search for **Scale set**, choose **Virtual machine scale set**
<p align="center">
    <img src="Images/004-Search Scale Set.png" width="80%" height="80%">

4. Select `Your Virtual machine Scale set`
<p align="center">
    <img src="Images/022-Scale set.png" width="80%" height="80%">

5. From the list of **Virtual machine Scale set**,Select **Instance**

6. Choose **on of the VM** 

<p align="center">
    <img src="Images/023-VM Instance.png" width="80%" height="80%">


7. Click the **Connect** button 

<p align="center">
    <img src="Images/025-VM Connect.png" width="80%" height="80%">


8.  Click **Download RDP file**
<p align="center">
    <img src="Images/026- VM RDF File.png" width="80%" height="80%">

9. Open the downloaded **RDP file** and **click Connect** when prompted

<p align="center">
    <img src="Images/028-connect.png" width="80%" height="80%">

<p align="center">
    <img src="Images/027-connect.png" width="80%" height="80%">

10. In the Windows Security window, select More choices and then Use a **different account**

<p align="center">
    <img src="Images/031-Other Account.png" width="80%" height="80%">

<p align="center">
    <img src="Images/029-userpassword.png" width="80%" height="80%">

11. Type the username as **localhost\username**

12. Enter password you created for the virtual machine scale set, and then click OK.
<p align="center">
    <img src="Images/030-VM.png" width="80%" height="80%">



### Clean up resources
In the resource group,**Delete resource**

* Virtual network

* Virtual machine Scale Set

* Load Balancer

* Network security group

* Public IP address


### Conclusion

Congratulations! You now have learned how to:

* Create Virtual network

* Create Virtual machine Scale Set

* Seeting AutoScale rule

* Create Load Balancer

* Ibound NAT rule

* Connect VM in VM Scale set


