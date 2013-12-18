<!-- Allow user to add new post -->
<div id="new_comic">
	<h1>Create a Comic</h1>
	<?php if(isset($error)): ?>
		<div class="error">
			<?=$error?>
			<br/>
		</div>
	<?php endif; ?>
	<!-- Add new post form -->
	
		<div id="tab-menu">
			<div id="tab-items">
				<ul>
					<li><a href="#title-tool">Title <span class="ui-icon ui-icon-pencil"></span></a></li>
					<li><a href="#background-tool">Backgrounds <span class="ui-icon ui-icon-image"></span></a></li>
					<li><a href="#character-tool">Characters <span class="ui-icon ui-icon-person"></span></a></li>
					<li><a href="#text-tool">Text <span class="ui-icon ui-icon-comment"></span></a></li>
					<li><a href="#print-tool">Print <span class="ui-icon ui-icon-print"></span></a></li>
				</ul>
			</div>
		
			<!-- title and credits tab -->
			<div id="title-tool">
				<header><h2>Enter a Title and Your Name</h2></header>
				<input type="text" id="title-text" maxlength="50" value="Your Title"/> by 
				<input type="text" id="author-text" maxlength="50" value="Your Name"/>
			</div>
			<!-- End title/credits tab/menu -->
			
			<!-- background picker -->
			<div id="background-tool">
				<!-- Panel selector for adding background -->
				<header><h2>1. Choose a Panel</h2></header>
				<input type="radio" name="panels" id="radio-panel-1" value="panel-1"/>&nbsp;<label for="radio-panel-1">Panel 1</label>
				<input type="radio" name="panels" id="radio-panel-2" value="panel-2"/>&nbsp;<label for="radio-panel-2">Panel 2</label>
				<input type="radio" name="panels" id="radio-panel-3" value="panel-3"/>&nbsp;<label for="radio-panel-3">Panel 3</label>
				<!-- Background selector -->
				<header><h2>2. Click a Background</h2></header>
				<div class="backgrounds" id="blank-bg"></div>
				<div class="backgrounds" id="indoor-bg"></div>
				<div class="backgrounds" id="outdoor-bg"></div>
				<div class="backgrounds" id="indoor-2-bg"></div>
				<div class="clearfix"></div>
			</div>
			<!-- End background picker -->
		
			<!-- Character tab for adding characters to comic -->
			<div id="character-tool">     
				<!--header><h2>Drag and Drop Characters to Panels</h2></header-->
				<header><h2>1. Click a Character to Preview and Edit</h2></header>
				<div class="selectable-characters" id="character-icon-1"></div>
				<div class="selectable-characters" id="character-icon-2"></div>
				<div class="selectable-characters" id="character-icon-3"></div>
				<div class="selectable-characters" id="character-icon-4"></div>
				<div class="selectable-characters" id="character-icon-5"></div>
				<!-- Area for previewing character before adding to strip -->
				<div id="character-preview-area">
					<header><h2 id="character-preview-header">2. Drag and Drop to a Panel</h2></header>
					<div id="character-preview" class="characters"></div>
					<!-- Clickable icon to flip balloon horizontally -->
					<span id="flip-character" class="ui-icon ui-icon-refresh" title="Flip"></span>
					<br/>
				</div>
				<div class="clearfix"></div>
				<header id="character-header-3"><h2>3. Delete a placed character by double-clicking it.</h2></header><br/>
				* Max 2 characters per panel
			</div>
			<!-- End Character tab/menu -->
			
			<!-- Text tab for adding text balloons to strip -->
			<div id="text-tool">
				<!-- Text balloon selections -->
				<header><h2>1. Select a Text Balloon</h2></header>
				<div class="balloons" id="thought-icon"></div>
				<div class="balloons" id="speech-icon"></div>
				<div class="balloons" id="caption-icon"></div>
				<div class="clearfix"></div>
				<!-- Area for previewing text and balloon before adding to strip -->
				<div id="preview-area">
					<header><h2 id="preview-header">2. Enter Text and Drag the Balloon to a Panel</h2></header>
					<textarea id="caption" maxlength="60" cols="22" rows="3" placeholder="TYPE TEXT HERE"></textarea>
					<div class="bubble-preview-span" id="preview-block">
						<blockquote id="bubble-preview">
							<p id="bubble-text"></p>
						</blockquote>
						<!-- Clickable icon to flip balloon horizontally -->
					</div>
					<span id="flip-bubble" class="ui-icon ui-icon-refresh" title="Flip"></span>
					<br/>
				</div>
				<div class="clearfix"></div>
				<header id="balloon-header-3"><h2>3. Delete a placed balloon by double-clicking it.</h2></header><br/>
				* Max 3 balloons per panel
			</div>
			<!-- End Text tab/menu -->
			
			<!-- Print tab for printing out comic strip -->
			<div id="print-tool">
				<header><h2>Click to Open a Printable Copy</h2></header>
				<input type="button" value="Print" id="print-btn"/><br/>
				<header><h2>Save Your Creation</h2></header>
				<label for="status">Make Public?</label>&nbsp;<input type="checkbox" value="public" id="status" name="status"/><input type="button" id="save" value="Save"/>
				<div id="processing"></div>
			</div>
			<!-- End print tab/menu -->
		</div>
		<!-- End menu/tools area -->

		<!-- Begin comic strip area -->
		<div id="comic-strip">
			<div id="comic-title">
				<span id="title">Your Title</span> by <span id="author">Your Name</span>
			</div>
			<!-- comic strip panels -->
			<div id="panel-1" class="comic-panels"></div>
			<div id="panel-2" class="comic-panels"></div>
			<div id="panel-3" class="comic-panels"></div>
			<div class="clearfix"></div>
			<div id="copy">all artwork &copy; 2013 donna wong</div>
		</div>
		<!-- End comic strip area -->
</div>