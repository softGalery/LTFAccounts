<div class="modal fade" id="liabilityDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Liability</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body col">
          <form id="liability-form-delete">
            <div class="mb-6">
                <h1 class="text-danger">Are you sure you want to delete this liability?</h1>
                <input type="text" class="form-control d-none" id="liabilityIdDelete" aria-describedby="loan_name">
            </div>  

          </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="liabilityDeleteClose" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
        <button type="button" onclick="deleteLiability()" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>

<script>
    async function deleteLiability(){
        let liabilityId = document.getElementById('liabilityIdDelete').value;
        document.getElementById('liabilityDeleteClose').click();

        loaderShow();
        let res = await axios.post("/delete-liability", {id:liabilityId});
        loaderHide();

        if (res.data === 1){
            successToast("Liability Deleted Successfully")
            document.getElementById('liability-form-delete').reset();
            await getLiability();
        }
        else {
            errorToast("Liability is not deleted! ")
        }
    }

</script>