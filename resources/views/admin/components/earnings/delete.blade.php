<div class="modal fade" id="earningDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog col-12 col-lg-10">
        <div class="modal-content col-12">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Earning</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body col-12">
                <form id="earning-delete">
                    <div class="container text-center">
                        <div class="row align-items-start">
                                <h1 class="text-danger">Once delete, you can't get it back</h1>
                                <div class="mb-5">
                                    <input type="text" class="form-control d-none" id="earningDeleteId">
                                </div>
                            </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="earning-delete-modal-close" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                <button type="button" onclick="deleteEarning()" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>
<script>
    async function deleteEarning(){
        let earningId = document.getElementById('earningDeleteId').value;
        document.getElementById('earning-delete-modal-close').click();

        let res = await axios.post("/delete-earning", {id:earningId})

        if(res.data===1){
            successToast("Earning Delete Successfully");
            document.getElementById('earning-delete').reset();
            await getEarning();
        }
        else{
            errorToast("Earning isn't delete!")
        }
    }
</script>