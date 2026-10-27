<div class="modal fade" id="acpayDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog col-12 col-lg-10">
        <div class="modal-content col-12">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Accounts Payable</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body col-12">
                <form id="accounts-delete">
                    <div class="container text-center">
                        <div class="row align-items-start">

                            <div class="col">
                                <h1 class="text-danger">Once delete, you can't get it back</h1>
                                <div class="mb-5">
                                    <input class="d-none" id="accountsDeleteID" />
                                </div>

                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="accounts-delete-modal-close" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" onclick="deleteAccountsPayable()" class="btn btn-primary">Delete</button>
            </div>
        </div>
    </div>
</div>
<script>
    async function deleteAccountsPayable()
    {
        let accountsId = document.getElementById('accountsDeleteID').value;
        document.getElementById('accounts-delete-modal-close').click();

        let res = await axios.post("/delete-accounts-payable", {id:accountsId})


        if (res.data===1){
            successToast("Accounts Payable Deleted Successfully")
            document.getElementById('accounts-delete').reset();
            await getAccountsPayableList();
        }
        else {
            errorToast("Accounts is not deleted! ")
        }

    }

</script>


