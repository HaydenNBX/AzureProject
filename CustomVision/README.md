# Azure Custom Vision 

## Prerequisite 前置要求
* Azure account 和 Subscription
* Your own resource group


## Getting Started
### Create Resource Group

* Click on `Resource groups`
![001-1-CreateRG.png](./images/001-1-CreateRG.png)

* Click `+Add` to add a resource groups
![001-2-CreateRG.png](./images/001-2-CreateRG.png)

* Select `Subscription`
* Name your `Resource group`
* Select the `Region` with `East US`
* Click on `Review + create`
![001-3-CreateRG.png](./images/001-3-CreateRG.png)

* Click `Create` after the validation passed
![001-4-CreateRG.png](./images/001-4-CreateRG.png)

* Wait until the deployment seccessed, you'll see your resource group show on the Resource groups page
* Enter your resource by click on it
![001-5-CreateRG.png](./images/001-5-CreateRG.png)
    > ⚠️ If the resource group that you create didn't show, please click `Refresh` to refresh the page

### Create Custom Vision
* Click `+Add` to add a resource inside your resource group
![002-1-CreateCustomVision.png](./images/002-1-CreateCustomVision.png)

* Seacrh `custom vision` using the searching bar, then click on `Csutom Vision`
![002-2-CreateCustomVision.png](./images/002-2-CreateCustomVision.png)

* Click `Create` to create custom vision
![002-3-CreateCustomVision.png](./images/002-3-CreateCustomVision.png)

* Choose `Both` on create options
* Select your `Subscriptions`
* Select your `Resource group` that you create just now
* Named the custom vision that you want（I use `democvision` for the name）
![002-4-CreateCustomVision.png](./images/002-4-CreateCustomVision.png)

* Select the `Training location`
* Select the `Training pricing tier`
* Select the `Prediction location`
* Select the `Prediction pricing tier`
* Click on `Review + create`
![002-5-CreateCustomVision.png](./images/002-5-CreateCustomVision.png)

* Click `Create` to create custom vision
![002-6-CreateCustomVision.png](./images/002-6-CreateCustomVision.png)

* Wait the deployment success
![002-7-CreateCustomVision.png](./images/002-7-CreateCustomVision.png)

* Choose `Go to resource` after the deployment is complete
![002-8-CreateCustomVision.png](./images/002-8-CreateCustomVision.png)

### Train you model
* Under `RESOURCE MANAGEMENT` section, choose `Quick start`
* Select `Custom Vision portal` to direct to a new browser page
![003-1-CVPortal.png](./images/003-1-CVPortal.png)

* Click `SIGN IN` (use the same account that you sign in to azure portal)
![003-2-CVPortal.png](./images/003-2-CVPortal.png)

* Click `NEW PROJECT` to create a new project
![003-3-CVPortal.png](./images/003-3-CVPortal.png)

* Name the project
* Add a `Description`
* Choose `Resource`
* Choose `Project Types`
* Choose `Domains`
* Choose `Create project`
![003-4-CVPortal.png](./images/003-4-CVPortal.png)

* Click `Add image` to add image to train
* Choose all the image files in `train` folder
![004-1-TrainImage.png](./images/004-1-TrainImage.png)

* Upload image
![004-2-TrainImage.png](./images/004-2-TrainImage.png)

* Wait the files uploading
![004-3-TrainImage.png](./images/004-3-TrainImage.png)

* Click `Done` when those images uploaded successfully
![004-4-TrainImage.png](./images/004-4-TrainImage.png)

* Now those images that we upload are `Untagged`
* Choose any image
![004-5-TrainImage.png](./images/004-5-TrainImage.png)

* Choose the area that you want to detect
* Give a tag to it (dollar in this demo)
* Tag all the train image that we uploaded by doing the previous two step
![004-6-TrainImage.png](./images/004-6-TrainImage.png)

* After taging all the images, we can see all the images classified to `Tagged` section
* Select `Train` to train model
![004-7-TrainImage.png](./images/004-7-TrainImage.png)

* Select `Quick Training` for this demo
* Click on `Train` button
![004-8-TrainImage.png](./images/004-8-TrainImage.png)

* Wait the model training
![004-9-TrainImage.png](./images/004-9-TrainImage.png)

* After the model train successfully, choose `Quick Test` to test the model
![004-10-TrainImage.png](./images/004-10-TrainImage.png)

* Click `Browse local files` to upload images (using any images in `test` files)
![005-1-TestImage.png](./images/005-1-TestImage.png)

* There's a result output 
![005-2-TestImage.png](./images/005-2-TestImage.png)

### Publish
* Select `Publish`
![006-1-Publish.png](./images/006-1-Publish.png)

* Name the `module`
* Selet the `Prediction resource`
* Click on `Publish`
![006-2-Publish.png](./images/006-2-Publish.png)

* Select Prediction URL
* For future use
![006-3-Publish.png](./images/006-3-Publish.png)

### Classification
* Click `NEW PROJECT` to create another project
![007-1-Class.png](./images/007-1-Class.png)

* Fill in the information needed
* Don't forget choose `Classification`
* `Multiclass` for Classification Types
![007-2-Class.png](./images/007-2-Class.png)

* Click on `Add images` to add images
![007-3-Class.png](./images/007-3-Class.png)

* Choose all the image files in `train` folder（TWD 1000）
* Remember to add `$1000` tag then `upload`
![007-4-Class.png](./images/007-4-Class.png)

* Wait for the images upload
![007-5-Class.png](./images/007-5-Class.png)

* Click `Done` when the image complete upload
![007-6-Class.png](./images/007-6-Class.png)

* `Add images` to add another type of images
![007-7-Class.png](./images/007-7-Class.png)

* Choose all the image files in `$100` folder
* Remember to add `$100` tag then `upload`
![007-8-Class.png](./images/007-8-Class.png)

* Click `Train`
* Choose `Quick Training` for Training Type
* Then `Train`
![007-9-Class.png](./images/007-9-Class.png)

* After the training jobs done, click on `Quick Test`
![007-10-Class.png](./images/007-10-Class.png)

* `Browse local files` to have a test
![007-11-Class.png](./images/007-11-Class.png)

* See the result output
![007-13-Class.png](./images/007-13-Class.png)

* There's a recogition error with TWD 1000 and mask
* We can train `mask type` images too prevent this kind of error
![007-12-Class.png](./images/007-12-Class.png)



## Clean Up
* Back to Azure portal
* Click on the resource group that you create
* Press `Delete resource group`
![008-1-CleanUp.png](./images/008-1-CleanUp.png)
