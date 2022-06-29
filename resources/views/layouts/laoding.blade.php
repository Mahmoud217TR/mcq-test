<script>
    window.addEventListener('load', (event) =>{
        document.getElementById("loading-screen-backdrop").classList.add('d-none');
        document.getElementById("loading-screen").classList.add('d-none');
    });
</script>
<div class="loading-screen-backdrop" id="loading-screen-backdrop"></div>
<div class="loading-screen" id='loading-screen'>
    <div class="loading-container">
        <div class="loading-circle"></div>
        <h1 class="text-center text-white">Loading...</h1>
    </div>
</div>