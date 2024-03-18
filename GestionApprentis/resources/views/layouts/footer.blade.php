</main>
<footer class="bg-dark text-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h4><span id="currentYear"></span> &copy; - Algérie Poste</h4>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>

<script>
    // JavaScript function to display current year
    document.getElementById("currentYear").innerText = new Date().getFullYear();
</script>
