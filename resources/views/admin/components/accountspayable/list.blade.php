<main class="dashboard-content">
    <div class="container-fluid px-3 px-lg-4 py-4">
        <div class="page-heading">
            
        </div>

        <section class="panel">
            <div class="panel-header"><div><h2 class="h5 mb-1 section-title"><i class="bi bi-table" aria-hidden="true"></i><span>List of Accounts Payable</span></h2><p class="text-muted mb-0">Searchable responsive table for orders and customer data.</p></div>
                <div class="create-asset">
                    <button type="button" class="btn btn-success display-flex float-end" data-bs-toggle="modal" data-bs-target="#assetCreate">Add New Asset</button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table align-middle mb-0" id="assetData" data-searchable-table>
                    <thead>
                    <tr>
                        <th>SL Number</th>
                        <th>Name of Accounts Payable</th>
                        <th>Description</th>
                        <th>invoice number</th>
                        <th>Bill date</th>
                        <th>Due date</th>
                        <th>Total Amount</th>
                        <th>Paid Amount</th>
                        <th>Balance</th>
                        <th>Status</th>
                        <th>Notes</th>
                        <th class="text-end">Action</th>
                    </tr>
                    </thead>
                    <tbody id="assetList">

                    </tbody>
                </table>

            </div>
        </section>
    </div>
</main>
<script>

</script>
