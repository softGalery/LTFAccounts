<!-- Modal -->
<div class="modal fade" id="accountsPayableUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Accounts Payable</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body col">
        
          <form id="accounts-payable-update-form">
            <div class="mb-6">
                <label for="accountsPayableName" class="form-label">Accounts Payable Name</label>
                <input type="text" class="form-control" id="accountsPayableNameUpdate" aria-describedby="accountsPayableName">
            </div>  
            <div class="mb-6">
                <label for="accountsPayableInvoiceNumber" class="form-label">Accounts Payable Invoice Number</label>
                <input type="number" class="form-control" id="accountsPayableInvoiceNumberUpdate" aria-describedby="accountsPayableInvoiceNumber">
            </div>
            <div class="mb-6">
                <label for="billDate" class="form-label">Bill Date</label>
                <input type="date" class="form-control" id="billDateUpdate" aria-describedby="billDate">
            </div>
            <div class="mb-6">
                <label for="dueDate" class="form-label">Due Date</label>
                <input type="date" class="form-control" id="dueDateUpdate" aria-describedby="dueDate">
            </div>
            <div class="mb-6">
                <label for="description" class="form-label">Accounts Payable Details</label>
                <input type="text" class="form-control" id="descriptionUpdate" aria-describedby="description">
            </div>
            <div class="mb-6">
                <label for="totalAmount" class="form-label">Total Amount</label>
                <input type="number" class="form-control" id="totalAmountUpdate" aria-describedby="totalAmount">
            </div>
            <div class="mb-6">
                <label for="paidAmount" class="form-label">Paid Amount</label>
                <input type="number" class="form-control" id="paidAmountUpdate" aria-describedby="paidAmount">
            </div>
            <div class="mb-6">
                <label for="status" class="form-label">Accounts Payable Status</label>
                <input type="number" class="form-control" id="statusUpdate" aria-describedby="status">
            </div>
            <div class="mb-6">
                <label for="note" class="form-label">Accounts Payable Note</label>
                <input type="text" class="form-control" id="acpNoteUpdate" aria-describedby="note">
            </div>
            <div class="mb-4">
                    <div class="form-check">
                            <input class="" id="accountsPayableUpdateID">
                    </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="acpUpdateClose" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" onclick="updateAccountsPayable()" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script>
    async function getAccountsDetails(id){
        document.getElementById('accountsPayableUpdateID').value = id;

        let res = await axios.post("/accounts-payable-by-id", {
            id: id
        });
        let accountsPayable = res.data;

        document.getElementById('accountsPayableNameUpdate').value = accountsPayable.name;
        document.getElementById('accountsPayableInvoiceNumberUpdate').value = accountsPayable.invoice_number;
        document.getElementById('billDateUpdate').value = accountsPayable.bill_date;
        document.getElementById('dueDateUpdate').value = accountsPayable.due_date;
        document.getElementById('descriptionUpdate').value = accountsPayable.description;
        document.getElementById('totalAmountUpdate').value = accountsPayable.total_amount;
        document.getElementById('paidAmountUpdate').value = accountsPayable.paid_amount;
        document.getElementById('statusUpdate').value = accountsPayable.status;
        document.getElementById('acpNoteUpdate').value = accountsPayable.note;
    }

    async function updateAccountsPayable(){
        let acp_id = document.getElementById('accountsPayableUpdateID').value;
        let name = document.getElementById('accountsPayableNameUpdate').value;
        let invoice_number = document.getElementById('accountsPayableInvoiceNumberUpdate').value;
        let bill_date = document.getElementById('billDateUpdate').value;
        let due_date = document.getElementById('dueDateUpdate').value;
        let description = document.getElementById('descriptionUpdate').value;
        let total_amount = document.getElementById('totalAmountUpdate').value;
        let paid_amount = document.getElementById('paidAmountUpdate').value;
        let status = document.getElementById('statusUpdate').value;
        let note = document.getElementById('acpNoteUpdate').value;

        if(name.length === 0){
            errorToast("Accounts Payable Name is Required");
        }
        else if(invoice_number.length === 0){
            errorToast("Accounts Payable Invoice Number is Required");
        }
        else if(bill_date.length === 0){
            errorToast("Accounts Payable Bill Date is Required");
        }
        else if(due_date.length === 0){
            errorToast("Accounts Payable Due Date is Required");
        }
        else if(description.length === 0){
            errorToast("Accounts Payable Description is Required");
        }
        else if(total_amount.length === 0){
            errorToast("Accounts Payable Total Amount is Required");
        }
        else if(paid_amount.length === 0){
            errorToast("Accounts Payable Paid Amount is Required");
        }
        else if(status.length === 0){
            errorToast("Accounts Payable Status is Required");
        }
        else if(note.length === 0){
            errorToast("Accounts Payable Note is Required");
        }
        else{
            document.getElementById('acpUpdateClose').click();
            
            let formData = new FormData();

            formData.append('id', acp_id);
            formData.append('name', name);
            formData.append('invoice_number', invoice_number);
            formData.append('bill_date',bill_date);
            formData.append('due_date', due_date);
            formData.append('description', description);
            formData.append('total_amount', total_amount);
            formData.append('paid_amount', paid_amount);
            formData.append('status', status);
            formData.append('note', note);

            loaderShow();
            let res=await axios.post("/update-accounts-payable", formData);
            loaderHide();

            if(res.status===200 && res.data.status==='success'){
                successToast('Accounts Payable Updated Successfully');
                document.getElementById('accounts-payable-update-form').reset();
                await getAccountsPayableList();
            }
            else{
                errorToast('Something went wrong');
            }
        }
            
    }

</script>


<style>
    img#oldImg {
        height: auto;
        width: 25%;
        margin: 15px;
    }

    #accountsPayableUpdate .modal-dialog {
        max-width: 40%;
        width: 45%;
        margin: 0 auto;
    }

</style>
