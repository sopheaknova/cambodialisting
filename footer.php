<?php global $smof_data; ?>
    
    <footer id="footer">
        <div class="container clearfix">
	        <div class="copyright">
	        <p><?php echo ($smof_data['footer_text'] !== '') ? $smof_data['footer_text'] : '&copy; ' . date('Y') . ' © 2013 Copyright by nova. All rights reserved.'; ?></p>
	        </div>
                
        </div><!--end .container -->
    </footer><!--end #footer-cols -->
 
</div>     
<!-- end .wrapper -->  

<?php wp_footer(); ?>

</body>
</html>