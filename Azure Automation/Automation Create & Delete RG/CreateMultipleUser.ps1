$connectionName = "AzureRunAsConnection"
try
{
    # Get the connection "AzureRunAsConnection "
    $servicePrincipalConnection=Get-AutomationConnection -Name $connectionName         

    Connect-AzAccount `
        -ServicePrincipal `
        -Tenant $servicePrincipalConnection.TenantId `
        -ApplicationId $servicePrincipalConnection.ApplicationId `
        -CertificateThumbprint $servicePrincipalConnection.CertificateThumbprint 
}
catch {
    if (!$servicePrincipalConnection)
    {
        $ErrorMessage = "Connection $connectionName not found."
        throw $ErrorMessage
    } else{
        Write-Error -Message $_.Exception
        throw $_.Exception
    }
}


for ($i = 10; $i -ge 1; $i--) {
    if($i -ne 0){
        $name = "user0" + $i
        Write-Output "==> $name create Success"
        New-AzResourceGroup -Name $name -Location "East US"
        Write-Output "Success"
    }
}

# $rgs = Get-AzResourceGroup | Where ResourceGroupName -like user*;

# foreach($resourceGroup in $rgs){
#     $name=  $resourceGroup.ResourceGroupName;
#     Write-Output $name
#     $count = (Get-AzResourceGroup | Where-Object{ $_.ResourceGroupName -match 'user' }).Count;
#     if($count -ne 0){
#         Write-Output "==> $name is empty. Deleting it...";
#         Remove-AzResourceGroup -Name $name -Force
#         Write-Output "Success"
#     }
# }

# $rgs = Search-AzGraph -Query "ResourceContainers | where type =~ 'microsoft.resources/subscriptions/resourcegroups' | project resourceGroup | where resourceGroup startswith 'user' | order by resourceGroup asc";

# foreach($resourceGroup in $rgs){
#     $name=  $resourceGroup.ResourceGroupName;
#     $count = (Get-AzResourceGroup | Where-Object{ $_.ResourceGroupName -match 'user' }).Count;
#     if($count -ne 0){
#         Remove-AzResourceGroup -Name $name -Force -WhatIf
#     }
# }



