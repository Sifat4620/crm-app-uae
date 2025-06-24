@extends('main.master')

@section('content')
<div class="content-body py-5" style="background: #f8f9fa;">
    <div class="container">

        <div class="text-end mb-3">
            <button id="downloadPdfBtn" class="btn btn-primary">
                Download PDF
            </button>
        </div>

        <div id="invoiceContent">
            <div class="card shadow-sm mx-auto" style="max-width: 900px;">
                <div class="card-body">

                    <!-- Invoice Header -->
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                        <div>
                            <h3 class="fw-bold mb-1">Invoice #1001</h3>
                            <p class="mb-1"><strong>Customer:</strong> John Doe</p>
                            <p class="mb-0">
                                <span class="badge bg-success text-capitalize">Paid</span>
                            </p>
                        </div>
                        <div class="text-end text-muted small">
                            <p class="mb-1"><strong>Date:</strong> 15 Jun 2025</p>
                        </div>
                    </div>

                    <!-- Company Info -->
                    <div class="d-flex justify-content-end align-items-center mb-4">
                        <div class="text-end me-3" style="min-width: 180px;">
                            <img src="{{ asset('images/logo.png') }}" alt="Company Logo" style="height: 50px; object-fit: contain;">
                        </div>
                        <div class="text-end">
                            <h5 class="mb-1 fw-semibold">Acme Corp.</h5>
                            <p class="mb-0 small text-muted">456 Industry Ave., Metropolis, MT 65432</p>
                            <p class="mb-0 small text-muted">Email: info@acmecorp.com | Phone: (123) 456-7890</p>
                        </div>
                    </div>

                    <!-- Orders Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Billing Cycle</th>
                                    <th scope="col" class="text-center">Quantity</th>
                                    <th scope="col" class="text-capitalize">Status</th>
                                    <th scope="col" class="text-end">Unit Price</th>
                                    <th scope="col" class="text-end">Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Premium Hosting</td>
                                    <td>Monthly</td>
                                    <td class="text-center">3</td>
                                    <td class="text-capitalize">Active</td>
                                    <td class="text-end">$29.99</td>
                                    <td class="text-end">$89.97</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Domain Registration</td>
                                    <td>Yearly</td>
                                    <td class="text-center">1</td>
                                    <td class="text-capitalize">Active</td>
                                    <td class="text-end">$12.00</td>
                                    <td class="text-end">$12.00</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>SSL Certificate</td>
                                    <td>Yearly</td>
                                    <td class="text-center">1</td>
                                    <td class="text-capitalize">Active</td>
                                    <td class="text-end">$49.99</td>
                                    <td class="text-end">$49.99</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="6" class="text-end fw-bold">Invoice Total:</th>
                                    <th class="text-end fw-bold">$151.96</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Footer -->
                    <div class="text-center text-muted mt-5 mb-0 small">
                        <p class="mb-1">Thank you for your business!</p>
                        <p class="mb-0">Acme Corp. - <a href="https://www.acmecorp.com" target="_blank" class="text-decoration-none">www.acmecorp.com</a></p>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<!-- Add scripts after content -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
    document.getElementById('downloadPdfBtn').addEventListener('click', function () {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF('p', 'pt', 'a4');
        const invoice = document.getElementById('invoiceContent');

        html2canvas(invoice, { scale: 2 }).then(canvas => {
            const imgData = canvas.toDataURL('image/png');
            const imgProps = doc.getImageProperties(imgData);
            const pdfWidth = doc.internal.pageSize.getWidth();
            const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

            doc.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
            doc.save('invoice.pdf');
        });
    });
</script>
@endsection
