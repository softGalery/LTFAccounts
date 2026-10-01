<div class="modal fade" id="assetUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog col-12 col-lg-10">
        <div class="modal-content col-12">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Asset</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body col-12">
                <form id="asset-update">
                    <div class="container text-center">
                        <div class="row align-items-start">
                            <div class="col border-end">
                                <div class="mb-5">
                                    <label for="recipient-name" class="col-form-label">Name:</label>
                                    <input type="text" class="form-control" id="assetNameUpdate">
                                </div>
                                <div class="mb-5">
                                    <label for="message-text" class="col-form-label">Description:</label>
                                    <textarea class="form-control" id="assetDescriptionUpdate"></textarea>
                                </div>
                                <div class="mb-5">
                                    <label for="message-text" class="col-form-label">Image:</label>
                                    <img class="w-15" id="assetImg" src="{{asset('assets/images/default.jpg')}}"/>
                                    <input oninput="assetImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control addCatName" id="assetImageUpdate" accept="image/*">
                                </div>
                                <div class="mb-5">
                                    <label for="message-text" class="col-form-label">Type:</label>
                                    <select class="form-select addCatName" id="assetTypeUpdate">
                                        <option value="" selected>Choose Type</option>
                                        <option >Fixed</option>
                                        <option >Current</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-5">
                                    <label for="message-text" class="col-form-label">Price:</label>
                                    <input type="number" class="form-control" id="asset-price-update">
                                </div>
                                <div class="mb-5">
                                    <label for="message-text" class="col-form-label">Purchases date:</label>
                                    <input type="date" class="form-control" id="asset-purchases-date-update">
                                </div>
                                <div class="mb-5">
                                    <label for="message-text" class="col-form-label">Estimated Life:</label>
                                    <input type="number" class="form-control" id="asset-estimated-lifeUpdate">
                                </div>
                                <div class="mb-5">
                                    <label for="message-text" class="col-form-label">Location:</label>
                                    <input class="form-control" id="asset-purchases-locationUpdate">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="form-check">
                            <input class="d-none" id="assetUpdateID">
                            <input class="d-none" id="assetUpdateFilePath">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="asset-update-modal-close" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" onclick="updateAsset()" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
<script>

    async function getAssetById(id, path){

        // Set hidden fields
        document.getElementById('assetUpdateID').value = id;
        document.getElementById('assetUpdateFilePath').value = path;

        // Show existing image first
        document.getElementById('assetImg').src = path;

        // Get asset from server
        let res = await axios.post("/asset-get-by-id", {
            id: id
        });

        let asset = res.data;
        
        document.getElementById('assetNameUpdate').value = asset.name;
        document.getElementById('assetDescriptionUpdate').value = asset.description;
        document.getElementById('assetImg').src = asset.asset_image;
        document.getElementById('assetTypeUpdate').value = asset.type;
        document.getElementById('asset-price-update').value = asset.price;
        document.getElementById('asset-purchases-date-update').value = asset.purchase_date;
        document.getElementById('asset-estimated-lifeUpdate').value = asset.estimated_lifetime;
        document.getElementById('asset-purchases-locationUpdate').value = asset.location;
        document.getElementById('assetUpdateID').value = asset.id;
        document.getElementById('assetUpdateFilePath').value = asset.asset_image;

    }
    
    async function updateAsset(){
        let assetId = document.getElementById('assetUpdateID').value;     // Get the asset ID from the hidden input field
        let assetFilePath = document.getElementById('assetUpdateFilePath').value;    // Get the file path of the existing image
        let assetNameUpdate = document.getElementById('assetNameUpdate').value;
        let assetDescriptionUpdate = document.getElementById('assetDescriptionUpdate').value;
        let assetImageUpdate = document.getElementById('assetImageUpdate').files[0];
        let assetTypeUpdate = document.getElementById('assetTypeUpdate').value;
        let assetPriceUpdate = document.getElementById('asset-price-update').value;
        let assetPurchasesDateUpdate = document.getElementById('asset-purchases-date-update').value;
        let assetEstimatedLifeUpdate = document.getElementById('asset-estimated-lifeUpdate').value;
        let assetLocationUpdate = document.getElementById('asset-purchases-locationUpdate').value;

        if (assetNameUpdate.length === 0)
        {
            errorToast('Please enter asset name');
        }
        else if (assetDescriptionUpdate.length === 0)
        {
            errorToast('Please enter asset description');
        }

        else if (assetTypeUpdate.length === 0)
        {
            errorToast('Please select asset type');
        }
        else if (assetPriceUpdate.length === 0)
        {
            errorToast('Please enter asset price');
        }
        else if (assetPurchasesDateUpdate.length === 0)
        {
            errorToast('Please select asset purchases date');
        }
        else if (assetEstimatedLifeUpdate.length === 0)
        {
            errorToast('Please enter asset estimated life');
        }
        else if (assetLocationUpdate.length === 0)
        {
            errorToast('Please enter asset location');
        }

        else {
            document.getElementById('asset-update-modal-close').click();

            let formData=new FormData();
            formData.append('id', assetId);
            formData.append('file_path', assetFilePath);
            formData.append('name',  assetNameUpdate);
            formData.append('description',  assetDescriptionUpdate);
            formData.append('type',  assetTypeUpdate);
            formData.append('price',  assetPriceUpdate);
            formData.append('purchase_date',  assetPurchasesDateUpdate);
            formData.append('estimated_lifetime',  assetEstimatedLifeUpdate);
            formData.append('location',  assetLocationUpdate);

            if (assetImageUpdate) {
                formData.append('asset_image', assetImageUpdate);    // Append the new image file only if it exists
            }

            loaderShow();
                let res = await axios.post("/asset-update", formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    });
            loaderHide();
            if (res.status===200 && res.data.status === 'success'){
                successToast("Asset Updated Successfully");
                document.getElementById('asset-update').reset();

                await getAssetList();
            }
            else {
                errorToast("Asset is not updated")
            }

        }
    };
</script>


<style>
    img#assetImg {
        height: auto;
        width: 25%;
        margin: 15px;
    }

        #assetUpdate .modal-dialog {
        max-width: 40%;
        width: 45%;
        margin: 0 auto;
    }

</style>
