<div class="modal fade" id="assetDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog col-12 col-lg-10">
        <div class="modal-content col-12">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Asset</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body col-12">
                <form id="asset-save">
                    <div class="container text-center">
                        <div class="row align-items-start">

                            <div class="col">
                                <h1 class="text-danger">Once delete, you can't get it back</h1>
                                <div class="mb-5">
                                    <input class="d-none" id="assetDeleteID" />
                                    <input class="d-none" id="assetDeleteFilePath" />
                                </div>

                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="asset-delete-modal-close" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" onclick="deleteAsset()" class="btn btn-primary">Delete</button>
            </div>
        </div>
    </div>
</div>
<script>
    async function deleteAsset(){
        let assetId = document.getElementById('assetDeleteID').value;
        let assetDeleteImage = document.getElementById('assetDeleteFilePath').value;
        document.getElementById('asset-delete-modal-close').click();

        let res = await axios.post("/asset-delete", {id:assetId, file_path:assetDeleteImage})


        if (res.data===1){
            successToast("Asset Deleted Successfully")
            await getAssetList();
        }
        else {
            errorToast("Asset is not deleted! ")
        }

    }

</script>


