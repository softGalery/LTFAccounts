<div class="modal fade" id="earningCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog col-12 col-lg-10">
        <div class="modal-content col-12">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Asset</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body col-12">
                <form id="earning-save">
                    <div class="container text-center">
                        <div class="row align-items-start">
                                <div class="mb-5">
                                    <label for="recipient-name" class="col-form-label">Name:</label>
                                    <input type="text" class="form-control" id="earningName">
                                </div>
                                <div class="mb-5">
                                    <label for="message-text" class="col-form-label">Description:</label>
                                    <textarea class="form-control" id="earninDescription"></textarea>
                                </div>
                                <div class="mb-5">
                                    <label for="message-text" class="col-form-label">Amounts:</label>
                                    <input type="number" class="form-control" id="earninAmount">
                                </div>
                                <div class="mb-5">
                                    <label for="message-text" class="col-form-label">Type:</label>
                                    <select class="form-select" id="earningType">
                                        <option value="" selected>Choose Type</option>
                                        <option value="cash">Cash</option>
                                        <option value="bank">Bank</option>
                                        <option value="accounts_receivable">Accounts Receivable</option>
                                    </select>
                                </div>
                            <div class="col">
                                <div class="mb-5">
                                    <label for="message-text" class="col-form-label">Earning Date:</label>
                                    <input type="date" class="form-control" id="earning_date">
                                </div>

                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="earning-modal-close" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" onclick="addEarning()" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    async function addEarning(){
    let earningsName = document.getElementById('earningName').value;
    let earningsDescription = document.getElementById('earninDescription').value;
    let earningsAmount = document.getElementById('earninAmount').value;
    let earningsType = document.getElementById('earningType').value;
    let earningsDate = document.getElementById('earning_date').value;

    if(earningsName.length === 0)
    {
        errorToast('Enter Earnings Name.')
    }
    else if(earningsDescription.length === 0)
    {
        errorToast('Enter Earning Description.')
    }
    else if(earningsAmount.length === 0)
    {
        errorToast('Enter Earning Amount')
    }
    else if(earningsType.length === 0)
    {
        errorToast('Select Earning Type')
    }
    else if(earningsDate.length === 0)
    {
        errorToast('Enter Date')
    }

    else{
        document.getElementById('earning-modal-close').click();

        let formData = new FormData();
        formData.append('name',  earningsName);
        formData.append('description', earningsDescription);
        formData.append('amount', earningsAmount);
        formData.append('type', earningsType);
        formData.append('earning_date', earningsDate);

        loaderShow();
        let res = await axios.post("/create-earning", formData);
        loaderHide();

        if(res.status===201)
        {
            successToast("Earning Added Successfully");
            document.getElementById('earning-save').reset();
            await getEarning();
        }
        else {
                errorToast("Earning is not added")
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
