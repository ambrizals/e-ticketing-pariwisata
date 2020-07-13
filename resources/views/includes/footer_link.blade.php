<div class="container-fluid bg-dark p-3 ">
	<ul class="footer-link">
		<li>{{ config('app.name') }} - © Copyright 2018. All right reserved.</li>
		<li><a href="https://www.ambrizal.net" class="text-white">About</a></li>
		<li><a href="mailto:sabuncolek@ambrizal.net" class="text-white">Contact</a></li>
	</ul>
</div>
<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalID" aria-hidden="true" data-url="{{ route('cart.index') }}/?quicklook">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="cartModalID">My Cart</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="content" class="modal-body py-0">

            </div>
            <div class="modal-footer">
            	<a href="{{ route('cart.index') }}" class="btn btn-primary">Checkout</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
<script src="{{ asset('js/lightgallery.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>