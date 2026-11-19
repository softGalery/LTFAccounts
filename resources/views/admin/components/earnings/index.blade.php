<main class="dashboard-content">
    <div class="container-fluid px-3 px-lg-4 py-4">
        <section class="panel">
            <div class="panel-header"><div><h2 class="h5 mb-1 section-title"><i class="bi bi-table" aria-hidden="true"></i><span>Earnings Table</span></h2><p class="text-muted mb-0"></p></div>
                <div class="create-asset">
                    <button type="button" class="btn btn-success display-flex float-end" data-bs-toggle="modal" data-bs-target="#earningCreate">Add Earning</button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table align-middle mb-0" id="earningData" data-searchable-table>
                    <thead>
                    <tr>
                        <th>SL Number</th>
                        <th>Earning Name</th>
                        <th>Description</th>
                        <th>amount</th>
                        <th>Type</th>
                        <th>Earning Date</th>
                        <th class="text-end">Action</th>
                    </tr>
                    </thead>
                    <tbody id="earningList">

                    </tbody>
                </table>

            </div>
        </section>
    </div>
</main>

<script>
    getEarning();
    async function getEarning(){
        let res = await axios.get("/get-earnings");
        
        let tableBody = $('#earningData');
        let tableList = $('#earningList');

        tableBody.DataTable().destroy();
        tableList.empty();

        res.data.forEach(function(earning, index){
            let row =`
                <tr>
                    <td class="fw-semibold">${index+1}</td>
                    <td class="fw-semibold">${earning['name']}</td>
                    <td class="fw-semibold">${earning['description']}</td>
                    <td class="fw-semibold">${earning['amount']}</td>
                    <td class="fw-semibold">${earning['type']}</td>
                    <td class="fw-semibold">${earning['earning_date']}</td>
                    <td class="fw-semibold">
                        <button data-id="${earning['id']}" class="btn earningEditBtn btn-sm btn-outline-primary rounded-5" type="button" data-bs-toggle="modal" data-bs-target="#assetUpdate">Edit</button>
                        <button data-id="${earning['id']}" class="btn earningDeleteBtn btn-sm btn-outline-danger rounded-5" data-bs-toggle="modal" data-bs-target="#assetDelete">Delete</button>
                    </td>
                 </tr>
            `
            tableList.append(row)
        });
        $(document).ready( function () {
            $('#earningData').DataTable({
                order: [[0, 'desc']],
                lengthMenu: [10, 20, 30, { label: 'All', value: -1 }]
            });
        } );
        
        $('.earningDeleteBtn').on('click', function(){
            let id = $(this).data('id');
            $('#earningDelete').modal('show');
            $('#earningDeleteId').val(id);
        })

    }
</script>