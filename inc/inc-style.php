<!-- ローディング -->
<style>
	.loading {
		position: fixed;
		z-index: 99999;
		top: 0;
		left: 0;
		display: flex;
		align-items: center;
		justify-content: center;
		width: 100vw;
		height: 100vh;
		transition: .4s .1s;
		background-color: #fff;
	}

	.loading.hide {
		visibility: hidden;
		opacity: 0;
	}

	.loader,
	.loader:after {
		width: 40px;
		height: 40px;
		border-radius: 50%;
	}

	.loader {
		position: relative;
		margin: 60px auto;
		font-size: 4px;
		transform: translateZ(0);
		animation: load8 1.1s infinite linear;
		text-indent: -9999em;
		border-top: 4px solid rgba(200, 200, 200, .2);
		border-right: 4px solid rgba(200, 200, 200, .2);
		border-bottom: 4px solid rgba(200, 200, 200, .2);
		border-left: 4px solid #fff;
	}

	@keyframes load8 {
		0% {
			transform: rotate(0deg);
		}

		100% {
			transform: rotate(360deg);
		}
	}

	@media all and (-ms-high-contrast: none) {
		.loading {
			display: none !important;
		}
	}
</style>

<noscript>
	<style>
		.loading {
			display: none;
		}
	</style>
</noscript>
