<?php

class timer
{
		function timer()
		{
				$this->start();
		}
		
		
		
		function start()
		{
				$this->start = $this->microtime_float();
		}
		
		
		function stop()
		{
				$this->stop = $this->microtime_float();
		}
		
		
		function marker($marker)
		{
				$marker_item['id'] = $marker;
				$marker_item['time'] = $this->microtime_float();
				$this->marker[] = $marker_item;
		}
		
		function render()
		{
				$out = '<br/>';
				
				if (isset($this->marker) && is_array($this->marker))
				{
						foreach ($this->marker as $marker)
						{
								$out .= $marker['id'] . ' : ';
								$out .= ($marker['time'] - $this->start);
								$out .= '<br/>';
						}
				}
				
				if (!isset($this->stop))
				{
						$this->stop();
				}
				$out .=  'stop : ' . ($this->stop - $this->start);
				
				//echo '<pre>';
				//print_r($this->marker);
				
				return $out;
		}
		
		
		function microtime_float()
		{
				list($usec, $sec) = explode(" ", microtime());
				return ((float)$usec + (float)$sec);
		}
		
}

?>
