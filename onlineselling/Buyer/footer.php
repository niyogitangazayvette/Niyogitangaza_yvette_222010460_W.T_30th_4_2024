    </div>
    <footer class="bg-info text-white py-3 text-center" id="footer">
        <p class="mb-0">© Designed By NIYOGITANGAZA Yvette</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Adjust footer position based on content height
        function adjustFooterPosition() {
            var contentHeight = $('.wrapper').outerHeight();
            var viewportHeight = $(window).height();
            var footerHeight = $('#footer').outerHeight();

            if (contentHeight + footerHeight < viewportHeight) {
                $('#footer').addClass('fixed-bottom');
            } else {
                $('#footer').removeClass('fixed-bottom');
            }
        }

        // Adjust footer position on window resize
        $(window).resize(function () {
            adjustFooterPosition();
        });

        // Initially adjust footer position
        $(document).ready(function () {
            adjustFooterPosition();
        });
    </script>
</body>
</html>