<!-- Modal -->
<div class="modal fade" id="acountsPayableCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Accounts Payable</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body col">
          <form id="accounts-payable-form">
            <div class="mb-6">
                <label for="accountsPayableName" class="form-label">Accounts Payable Name</label>
                <input type="text" class="form-control" id="accountsPayableName" aria-describedby="accountsPayableName">
            </div>  
            <div class="mb-6">
                <label for="accountsPayableInvoiceNumber" class="form-label">Accounts Payable Invoice Number</label>
                <input type="number" class="form-control" id="accountsPayableInvoiceNumber" aria-describedby="accountsPayableInvoiceNumber">
            </div>
            <div class="mb-6">
                <label for="billDate" class="form-label">Bill Date</label>
                <input type="date" class="form-control" id="billDate" aria-describedby="billDate">
            </div>
            <div class="mb-6">
                <label for="dueDate" class="form-label">Due Date</label>
                <input type="date" class="form-control" id="dueDate" aria-describedby="dueDate">
            </div>
            <div class="mb-6">
                <label for="description" class="form-label">Accounts Payable Details</label>
                <input type="text" class="form-control" id="description" aria-describedby="description">
            </div>
            <div class="mb-6">
                <label for="totalAmount" class="form-label">Total Amount</label>
                <input type="number" class="form-control" id="totalAmount" aria-describedby="totalAmount">
            </div>
            <div class="mb-6">
                <label for="paidAmount" class="form-label">Paid Amount</label>
                <input type="number" class="form-control" id="paidAmount" aria-describedby="paidAmount">
            </div>
            <div class="mb-6">
                <label for="status" class="form-label">Accounts Payable Status</label>
                <input type="number" class="form-control" id="status" aria-describedby="status">
            </div>
            <div class="mb-6">
                <label for="note" class="form-label">Accounts Payable Note</label>
                <input type="text" class="form-control" id="acpNote" aria-describedby="note">
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="acpClose" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" onclick="createAccountsPayable()" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script>
  async function createAccountsPayable(){
    const acpName = document.getElementById('accountsPayableName').value;
    const acpInvoiceName = document.getElementById('accountsPayableInvoiceNumber').value;
    const acpBillDate = document.getElementById('billDate').value;
    const acpDueDate = document.getElementById('dueDate').value;
    const acpDetails = document.getElementById('description').value;
    const acpTotalAmount = document.getElementById('totalAmount').value;
    const acpPaidAmount = document.getElementById('paidAmount').value;
    const acpStatus = document.getElementById('status').value;
    const acpNote = document.getElementById('acpNote').value;

    if(acpName.length === 0)
      {
        errorToast("Accounts Payable Name is Required");
      }

      else if(acpInvoiceName.length === 0)
      {
        errorToast("Enter Accounts Payable Invoice Number");
      }
      else if(acpBillDate.length === 0)
      {
        errorToast("Enter Accounts Payable Bill Date");
      }
      else if(acpDueDate.length === 0)
      {
        errorToast("Enter Accounts Payable Due Date");
      }
      else if(acpDetails.length === 0)
      {
        errorToast("Enter Accounts Payable Details");
      }
      else if(acpTotalAmount.length === 0)
      {
        errorToast("Enter Accounts Payable Total Amount");
      }
      else if(acpPaidAmount.length === 0)
      {
        errorToast("Enter Accounts Payable Paid Amount");
      }
      else if(acpStatus.length === 0)
      {
        errorToast("Enter Accounts Payable Status");
      }
      else if(acpNote.length === 0)
      {
        errorToast("Enter Accounts Payable Note");
      }
      else
        {
          document.getElementById('acpClose').click();
          let formData = new FormData();
          formData.append('name', acpName);
          formData.append('invoice_number', acpInvoiceName);
          formData.append('bill_date', acpBillDate);
          formData.append('due_date', acpDueDate);
          formData.append('description', acpDetails);
          formData.append('total_amount', acpTotalAmount);
          formData.append('paid_amount', acpPaidAmount);
          formData.append('status', acpStatus);
          formData.append('note', acpNote);

          loaderShow();
          const res = await axios.post('/create-acconts-payable', formData);
          loaderHide();
          if(res.status ===201 && res.data.status === 'success')
          {
            successToast("Accounts Payable Added Successfully");
            document.getElementById('accounts-payable-form').reset();
            getAccountsPayableList();
          }
          else
          {
            errorToast("Accounts Payable is not added");
          }

        }

    // Add more field values as needed
  }
</script>
