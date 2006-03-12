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


