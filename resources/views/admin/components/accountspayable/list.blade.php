<main class="dashboard-content">
    <div class="container-fluid px-3 px-lg-4 py-4">
        <div class="page-heading">           
        </div>
        <section class="panel">
            <div class="panel-header"><div><h2 class="h5 mb-1 section-title"><i class="bi bi-table" aria-hidden="true"></i><span>List of Accounts Payable</span></h2><p class="text-muted mb-0">Searchable responsive table for orders and customer data.</p></div>
                <div class="create-asset">
                    <button type="button" class="btn btn-success display-flex float-end" data-bs-toggle="modal" data-bs-target="#acountsPayableCreate">Add New Accounts Payable</button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table align-middle mb-0" id="acPayData" data-searchable-table>
                    <thead>
                    <tr>
                        <th>SL Number</th>
                        <th>Name of Accounts<br> Payable</th>
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
                    <tbody id="acPayList">

                    </tbody>
                </table>

            </div>
        </section>
    </div>
</main>
<script>
    getAccountsPayableList();

    async function getAccountsPayableList() {
        let res = await axios.get("/accounts-payable-list");

        let tableBody = $('#acPayData');
        let tableList = $('#acPayList');

        tableBody.DataTable().destroy();
        tableList.empty();

        res.data.forEach( function (acItem, index) {
            let row = `
                <tr>
                    <td class="fw-semibold">${index+1}</td>
                    <td class="fw-semibold">${acItem['name']}</td>
                    <td class="fw-semibold">${acItem['description']}</td>
                    <td class="fw-semibold">${acItem['invoice_number']}</td>
                    <td class="fw-semibold">${acItem['bill_date']}</td>
                    <td class="fw-semibold">${acItem['due_date']}</td>
                    <td class="fw-semibold">${acItem['total_amount']}</td>
                    <td class="fw-semibold">${acItem['paid_amount']}</td>
                    <td class="fw-semibold">${acItem['balance_amount']}</td>
                    <td class="fw-semibold">${acItem['status']}</td>
                    <td class="fw-semibold">${acItem['note']}</td>
                    <td class="fw-semibold">
                        <button data-id="${acItem['id']}" class="btn acPayUpdateBtn btn-sm btn-outline-primary rounded-5" type="button" data-bs-toggle="modal" data-bs-target="#acPayUpdate">Edit</button>
                        <button data-id="${acItem['id']}" class="btn acPayDeleteBtn btn-sm btn-outline-danger rounded-5" data-bs-toggle="modal" data-bs-target="#acPayDelete">Delete</button>
                    </td>
                </tr>`;
            tableList.append(row);
        });

        $(document).ready( function () {
            $('#acPayData').DataTable({
                order: [[0, 'desc']],
                lengthMenu: [10, 20, 30, { label: 'All', value: -1 }]
            });
        } );

        $('.acPayDeleteBtn').on('click',async function (){
            let id = $(this).data('id');
            $('#accpDeletedId').val(id);
            $('#accpDeleteModal').modal('show');
            await getAccountsPayableList(id);
        })
    }

</script>
