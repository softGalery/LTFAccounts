<div class="modal fade" id="earningEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog col-12 col-lg-10">
        <div class="modal-content col-12">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Earning</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body col-12">
                <form id="earning-edit">
                    <div class="container text-center">
                        <div class="row align-items-start">
                                <div class="mb-5">
                                    <label for="recipient-name" class="col-form-label">Name:</label>
                                    <input type="text" class="form-control" id="earningNameEdit">
                                </div>
                                <div class="mb-5">
                                    <label for="message-text" class="col-form-label">Description:</label>
                                    <textarea class="form-control" id="earninDescriptionEdit"></textarea>
                                </div>
                                <div class="mb-5">
                                    <label for="message-text" class="col-form-label">Amounts:</label>
                                    <input type="number" class="form-control" id="earninAmountEdit">
                                </div>
                                <div class="mb-5">
                                    <label for="message-text" class="col-form-label">Type:</label>
                                    <select class="form-select" id="earningTypeEdit">
                                        <option value="" selected>Choose Type</option>
                                        <option value="cash">Cash</option>
                                        <option value="bank">Bank</option>
                                        <option value="accounts_receivable">Accounts Receivable</option>
                                    </select>
                                </div>
                            <div class="col">
                                <div class="mb-5">
                                    <label for="message-text" class="col-form-label">Earning Date:</label>
                                    <input type="date" class="form-control" id="earning_dateEdit">
                                </div>
                                <div class="mb-5">
                                    <input type="text" class="form-control d-none" id="earningEditId">
                                </div>

                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="earning-modal-close-edit" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" onclick="editEarning()" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>

<script>
    // This section for edit form fillup
    async function fillupForm(id){
        document.getElementById('earningEditId').value = id;

        let res = await axios.post("/get-earning-by-id", {id: id});

        let earnings = res.data;
        // Fillup form
        document.getElementById('earningNameEdit').value = earnings.name;
        document.getElementById('earninDescriptionEdit').value = earnings.description;
        document.getElementById('earninAmountEdit').value = earnings.amount;
        document.getElementById('earningTypeEdit').value =earnings.type;
        document.getElementById('earning_dateEdit').value = earnings.earning_date;
    }
    // This section for edit form
    async function editEarning(){
    let earningsNameEdit = document.getElementById('earningNameEdit').value;
    let earningsDescriptionEdit = document.getElementById('earninDescriptionEdit').value;
    let earningsAmountEdit = document.getElementById('earninAmountEdit').value;
    let earningsTypeEdit = document.getElementById('earningTypeEdit').value;
    let earningsDateEdit = document.getElementById('earning_dateEdit').value;
    let earningId = document.getElementById('earningEditId').value;

    if(earningsNameEdit.length === 0)
    {
        errorToast('Enter Earnings Name.')
    }
    else if(earningsDescriptionEdit.length === 0)
    {
        errorToast('Enter Earning Description.')
    }
    else if(earningsAmountEdit.length === 0)
    {
        errorToast('Enter Earning Amount')
    }
    else if(earningsTypeEdit.length === 0)
    {
        errorToast('Select Earning Type')
    }
    else if(earningsDateEdit.length === 0)
    {
        errorToast('Enter Date')
    }

    else{
        document.getElementById('earning-modal-close-edit').click();

        let formData = new FormData();
        formData.append('name',  earningsNameEdit);
        formData.append('description', earningsDescriptionEdit);
        formData.append('amount', earningsAmountEdit);
        formData.append('type', earningsTypeEdit);
        formData.append('earning_date', earningsDateEdit);
        formData.append('id', earningId)

        loaderShow();
        let res = await axios.post("/edit-earning", formData);
        loaderHide();

        if(res.status===200 && res.data.status === 'success')
        {
            successToast("Earning Edit Successfully");
            document.getElementById('earning-edit').reset();
            await getEarning();
        }
        else {
                errorToast("Earning Edit failed!")
            }
    }
    }
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
