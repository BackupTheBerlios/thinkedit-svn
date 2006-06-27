  </div><!-- end main -->
            
            <div id="sub">
						
						
						</div><!-- end sub -->
            
            
            <div id="local">
						<h2>Local</h2>
						<ul>
						 <?php if ($context_menu = te_context_menu()) : ?>
						 <?php foreach ($context_menu as $context_menu_item): ?>
							<li><a href="<?php echo te_link($context_menu_item->node);?>"><?php echo te_short($context_menu_item->getTitle(), 25); ?></a></li>
						<?php endforeach; ?>
						<?php endif; ?>
						</ul>
                
            </div><!-- end sub -->
            
            
            <div id="nav">
                <div class="wrapper">
                <h2 class="accessibility">Navigation</h2>
                <ul class="clearfix">
								<?php if ($main_menu = te_main_menu()) : ?>
						<?php foreach ($main_menu as $main_menu_item): ?>
						<li><a href="<?php echo te_link($main_menu_item->node);?>"><?php echo $main_menu_item->getTitle(); ?></a></li> 
						<?php if (!$main_menu_item->isEnd()):?><span class="menu_separator"></span><?php endif; ?>
						<?php endforeach; ?>
						<?php endif; ?>
								
								
                   
                </ul>
                </div>
                <hr />
            </div><!-- end nav -->
            
        </div><!-- end content -->
        
        
        <div id="footer" class="clearfix">
            <p>&copy; Copyright 2005 Nobody</p>
        </div><!-- end footer -->
        
    </div><!-- end page -->
    
    <div id="extra1">&nbsp;</div>
    <div id="extra2">&nbsp;</div>
    
</body>
</html>


</div>
								</div>

								<div id="navigation">
										<?php if (isset($context_menu)) : ?>
										<?php echo $context_menu->render() ?>
										<?php endif; ?>
										
										<?php if (isset($child_menu)) : ?>
										<?php echo $child_menu->render() ?>
										<?php endif; ?>
										
								</div>

								<div id="extra">
								Extra info here
								</div>

								<div id="footer">
								footer here
								</div>
						</div>
						
						
				</body>
		</html>


