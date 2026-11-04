<div class="modal fade" id="liabilityCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Liability</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body col">
          <form id="liability-form">
            <div class="mb-6">
                <label for="loan_name" class="form-label">Loan Name</label>
                <input type="text" class="form-control" id="loan_name" aria-describedby="loan_name">
            </div>  
            <div class="mb-6">
                <label for="lender_name" class="form-label">Lender Name</label>
                <input type="text" class="form-control" id="lender_name" aria-describedby="lender_name">
            </div>
            <div class="mb-6">
                <label for="loan_amount" class="form-label">Loan Amount</label>
                <input type="number" class="form-control" id="loan_amount" aria-describedby="loan_amount">
            </div>
            <div class="mb-6">
                <label for="interest_rate" class="form-label">Interest Rate</label>
                <input type="number" class="form-control" id="interest_rate" aria-describedby="interest_rate">
            </div>
            <div class="mb-6">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="start_date" aria-describedby="start_date">
            </div>
            <div class="mb-6">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" class="form-control" id="end_date" aria-describedby="end_date">
            </div>
            <div class="mb-6">
                <label for="paid" class="form-label">Paid Amount</label>
                <input type="number" class="form-control" id="paid" aria-describedby="paid">
            </div>
            <div class="mb-6">
                <label for="notes" class="form-label">Notes</label>
                <textarea class="form-control" id="notes" aria-describedby="notes"></textarea>
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="lbClose" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" onclick="createLiability()" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
    async function createLiability()
    {
        let name = document.getElementById('loan_name').value;
        let lender = document.getElementById('lender_name').value;
        let amount = document.getElementById('loan_amount').value;
        let rate = document.getElementById('interest_rate').value;
        let start = document.getElementById('start_date').value;
        let end = document.getElementById('end_date').value;
        let paid = document.getElementById('paid').value;
        let notes = document.getElementById('notes').value;

        if (name.length === 0)
        {
            errorToast("Loan name is required");
        }
        else if (lender.length === 0)
        {
            errorToast("Lender name is required")
        }
        else if (amount.length === 0)
        {
            errorToast("Loan amount is required")
        }
        else if (rate.length === 0)
        {
            errorToast("Interest rate is required")
        }
        else if (start.length === 0)
        {
            errorToast("Start date is required")
        }
        else if (end.length === 0)
        {
            errorToast("End date is required")
        }   
        else if (paid.length === 0)
        {
            errorToast("Paid amount is required")
        }
        else if (notes.length === 0)
        {
            errorToast("Notes is required")
        }

        else
        {
            document.getElementById('lbClose').click();

            let formData = new FormData();
            formData.append('loan_name', name);
            formData.append('lender_name', lender);
            formData.append('loan_amount', amount);
            formData.append('interest_rate', rate);
            formData.append('start_date', start);
            formData.append('end_date', end);
            formData.append('paid', paid);  
            formData.append('notes', notes);

            loaderShow();
            let res = await axios.post('/create-liability', formData);
            loaderHide();

            if (res.status === 201)
            {
                successToast("Liability Created Successfully")
                document.getElementById('liability-form').reset();
                await getLiability();
            }
            else
            {
                errorToast("Liability is not created")
            }

        }
        

    }
</script>



