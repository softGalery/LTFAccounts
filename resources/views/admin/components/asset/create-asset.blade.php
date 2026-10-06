<div class="modal fade" id="assetCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog col-12 col-lg-10">
        <div class="modal-content col-12">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Asset</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body col-12">
                <form id="asset-save">
                    <div class="container text-center">
                        <div class="row align-items-start">
                            <div class="col border-end">
                                <div class="mb-5">
                                    <label for="recipient-name" class="col-form-label">Name:</label>
                                    <input type="text" class="form-control" id="assetName">
                                </div>
                                <div class="mb-5">
                                    <label for="message-text" class="col-form-label">Description:</label>
                                    <textarea class="form-control" id="assetDescription"></textarea>
                                </div>
                                <div class="mb-5">
                                    <label for="message-text" class="col-form-label">Image:</label>
                                    <img class="w-15" id="newImg" src="{{asset('assets/images/default.jpg')}}"/>
                                    <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control addCatName" id="assetImage">
                                </div>
                                <div class="mb-5">
                                    <label for="message-text" class="col-form-label">Type:</label>
                                    <select class="form-select addCatName" id="assetType">
                                        <option value="" selected>Choose Type</option>
                                        <option >Fixed</option>
                                        <option >Current</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-5">
                                    <label for="message-text" class="col-form-label">Price:</label>
                                    <input type="number" class="form-control" id="asset-price">
                                </div>
                                <div class="mb-5">
                                    <label for="message-text" class="col-form-label">Purchases date:</label>
                                    <input type="date" class="form-control" id="asset-purchases-date">
                                </div>
                                <div class="mb-5">
                                    <label for="message-text" class="col-form-label">Estimated Life:</label>
                                    <input type="number" class="form-control" id="asset-estimated-life">
                                </div>
                                <div class="mb-5">
                                    <label for="message-text" class="col-form-label">Location:</label>
                                    <input class="form-control" id="asset-purchases-location">
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="asset-modal-close" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" onclick="createAsset()" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
<script>
    
    async function createAsset(){
        let assetName = document.getElementById('assetName').value;
        let assetDescription = document.getElementById('assetDescription').value;
        let assetImage = document.getElementById('assetImage').files[0];
        let assetType = document.getElementById('assetType').value;
        let assetPrice = document.getElementById('asset-price').value;
        let assetPurchasesDate = document.getElementById('asset-purchases-date').value;
        let assetEstimatedLife = document.getElementById('asset-estimated-life').value;
        let assetLocation = document.getElementById('asset-purchases-location').value;

        if (assetName.length === 0)
        {
            errorToast('Please enter asset name');
        }
        else if (assetDescription.length === 0)
        {
            errorToast('Please enter asset description');
        }
        else if (!assetImage)
        {
            errorToast('Please select asset image');
        }
        else if (assetType.length === 0)
        {
            errorToast('Please select asset type');
        }
        else if (assetPrice.length === 0)
        {
            errorToast('Please enter asset price');
        }
        else if (assetPurchasesDate.length === 0)
        {
            errorToast('Please select asset purchases date');
        }
        else if (assetEstimatedLife.length === 0)
        {
            errorToast('Please enter asset estimated life');
        }
        else if (assetLocation.length === 0)
        {
            errorToast('Please enter asset location');
        }

        else {
            document.getElementById('asset-modal-close').click();
            let formDate=new FormData();
            formDate.append('name',  assetName);
            formDate.append('description',  assetDescription);
            formDate.append('asset_image',  assetImage);
            formDate.append('type',  assetType);
            formDate.append('price',  assetPrice);
            formDate.append('purchase_date',  assetPurchasesDate);
            formDate.append('estimated_lifetime',  assetEstimatedLife);
            formDate.append('location',  assetLocation);

            loaderShow();
                let res = await axios.post("/asset-add", formDate, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    });
            loaderHide();
            if (res.status===201){
                successToast("Asset Added Successfully");
                document.getElementById('asset-save').reset();

                await getAssetList();
            }
            else {
                errorToast("Asset is not added")
            }

        }
    };
</script>


<style>
    img#newImg {
        height: auto;
        width: 25%;
        margin: 15px;
    }

        #assetCreate .modal-dialog {
        max-width: 40%;
        width: 45%;
        margin: 0 auto;
    }

</style>
