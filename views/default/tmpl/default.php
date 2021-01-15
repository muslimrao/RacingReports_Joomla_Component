<?php

/**
 * Author:	Muslim Raza
 * Email:	fairsit.m@gmail.com
 * Website:	https://www.linkedin.com/in/muslim-raza-70105228/
 * Component:Report Incidents
 * Version:	3.0.0
 * Date:		12/01/2021
 * copyright	Copyright (C) 2021 https://www.linkedin.com/in/muslim-raza-70105228/. All Rights Reserved.
 **/

use ParagonIE\Sodium\Core\Util;

// no direct access
defined('_JEXEC') or die;

if (false) {
?>
	<!-- Report Incidents 3.0.0 starts here -->
	<div class="ReportIncidents<?php echo $this->pageclass_sfx; ?>">
		<?php if ($this->params->get('show_page_heading', 1)) : ?>
			<h1>
				<?php if ($this->escape($this->params->get('page_heading'))) : ?>
					<?php echo $this->escape($this->params->get('page_heading')); ?>
				<?php else : ?>
					<?php echo $this->escape($this->params->get('page_title')); ?>
				<?php endif; ?>
			</h1>
		<?php endif; ?>
	</div>
	<!-- Report Incidents 3.0.0 ends here -->
<?php
}

?>

<div class="bodyinci">



	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableinci">

		<!--
        <tr>
            <td>
			   
			   
                <select name="category" class="form-control">
                    <option value="">Select Category</option>
                </select>
                <br>

            </td>

            <td></td>
            <td><select name="track" class="form-control">
                    <option value="">Select Track</option>
     
                </select>
                <br>

            </td>
        </tr>
        
        <tr>
            <td height="10" colspan="3"></td>
        </tr>
           
        <tr>
            <td colspan="">
                <h1 class="">Victim</h1>
            </td>
            <td colspan="">

            </td>
            <td colspan="">
                <h1 class="">Guilty</h1>
            </td>

        </tr>
        <tr>
            <td height="10" colspan="3"></td>
        </tr>
     -->

		<tr>
			<td width="45%">


				<div class="show_victim_dropdown" style="display: none;">
					<select name="victim_racer" data-type="v" class="form-control">
						<option value="">Select a racer video</option>

					</select>

				</div>

				<br>

			</td>

			<td width="10%"></td>
			<td width="45%">

				<?php

				$fetch_guilty_racer       = mysqli_query(UtilHelper::getMySql_Connection(), "select  DISTINCT(Reportado) from incidentes where Reportado IN (select DISTINCT(Piloto) FROM `parc_ferme`)");
				?>

				<div class="show_guilty_dropdown">
					<select name="select_guilty_racer" data-type="g">
						<option value="">Select a racer video</option>

					</select>
				</div>


			</td>
		</tr>

		<tr>
			<td height="10" colspan="3"></td>
		</tr>

		<tr style="background-color: black;">
			<td width="45%" align="center">

				<div class="play_victim_video">
					<div id="victim_video">
						<img src="<?php echo UtilHelper::getReportIncidentAssetUrl(); ?>images/video-placeholder.png" />
					</div>
				</div>

			</td>

			<td width="10%" align="center">



				<table border="1" style="text-align: center; font-weight:bold; cursor:pointer; background-color:black;" cellpadding="10">

					<tr>
						<td onclick="set_reports('3 Seg')"><img src="<?php echo UtilHelper::getReportIncidentAssetUrl(); ?>images/3-seg.png" /></td>
						<td onclick="set_reports('10 Seg')"><img src="<?php echo UtilHelper::getReportIncidentAssetUrl(); ?>images/10-seg.png" /></td>
					</tr>

					<tr>
						<td onclick="set_reports('5 Seg')"><img src="<?php echo UtilHelper::getReportIncidentAssetUrl(); ?>images/5-seg.png" /></td>
						<td onclick="set_reports('20 Seg')"><img src="<?php echo UtilHelper::getReportIncidentAssetUrl(); ?>images/20-seg.png" /></td>
					</tr>

					<tr>
						<td onclick="set_reports('Race Ban')"><img src="<?php echo UtilHelper::getReportIncidentAssetUrl(); ?>images/race-ban.png" /></td>
						<td onclick="set_reports('20 Grid')"><img src="<?php echo UtilHelper::getReportIncidentAssetUrl(); ?>images/20-grid.png" /></td>
					</tr>

					<tr>
						<td onclick="set_reports('!')"><img src="<?php echo UtilHelper::getReportIncidentAssetUrl(); ?>images/red-icon.png" /></td>
						<td onclick="set_reports('!!')"><img src="<?php echo UtilHelper::getReportIncidentAssetUrl(); ?>images/orange-icon.png" /></td>
					</tr>

					<tr>
						<td onclick="set_reports('NFA')" colspan="2"><img src="<?php echo UtilHelper::getReportIncidentAssetUrl(); ?>images/nfa.png" /></td>

					</tr>

					<tr>
						<td onclick="set_reports('SWAP')" colspan="2"><img src="<?php echo UtilHelper::getReportIncidentAssetUrl(); ?>images/swap-icon.png" /></td>

					</tr>
					<tr>
						<td onclick="set_reports('NEW CRASH')" colspan="2"><img src="<?php echo UtilHelper::getReportIncidentAssetUrl(); ?>images/new-crash.png" /></td>

					</tr>

				</table>


			</td>
			<td width="45%" align="center">
				<div class="play_guilty_video">
					<div id="guilty_video">

						<img src="<?php echo UtilHelper::getReportIncidentAssetUrl(); ?>images/video-placeholder.png" />
					</div>
				</div>






			</td>
		</tr>



		<tr style="background-color: black; color:white; text-align:left" class="verticalalign-top">
			<td width="45%">
				<div class="div_victim_guilty_names">
					<h1 class=""> Victim: </h1>
					<h1 class="span_victim_name"></h1>
				</div>
			</td>

			<td width="10%">

			</td>


			<td width="45%">
				<div class="div_victim_guilty_names">
					<h1 class=""> Guilty: </h1>
					<h1 class="span_guilty_name">

					</h1>
				</div>


				<div class="no_guilty_video_found " style="display: none;">
					<div class="" style="margin-top:10px; display: flex;">
						<div class="alert alert-danger html " style="font-weight: bold;">

							<strong>Guilty video not found for:</strong>
						</div>
					</div>
				</div>
			</td>
		</tr>




		<tr style="background-color: black; color:white; text-align:left;">
			<td width="45%">




			</td>

			<td width="10%">






			</td>
			<td width="45%">
				<div class="juez_images" style="">

				</div>






			</td>
		</tr>



		<tr style="background-color: black; color:white; text-align:left;">

			<td width="10%" colspan="3">






			</td>

		</tr>



	</table>


	<table class="typeOfIncidents details-grid" cellspacing="0" style="width: 100%;">
		<tr>
			<td class="width-45perc verticalalign-top">
				<table class="typeOfIncidents tddisplayinline" cellspacing="10" style="width: 100%;">
					<tr>
						<td><strong>Type of Incident: </strong></td>
						<td class="type_of_incident"></td>
					</tr>

					<tr>
						<td width=""><strong>Summary of Incident:</strong></td>
						<td class="summary_of_incident"></td>
					</tr>

					<tr>
						<td><strong>Fecha: </strong></td>
						<td class="fetcha"></td>
					</tr>
				</table>
			</td>

			<td class="width-10perc">
			</td>
			<td class="width-45perc verticalalign-top">
				<table class="typeOfIncidents tddisplayinline" cellspacing="10" style="width: 100%;">

					<tr>
						<td><strong>Lap: </strong></td>
						<td class="lap"></td>
					</tr>

					<tr>
						<td><strong>Resolucion: </strong></td>
						<td class="incident_penalties_remarks">

							<input id="incident_tags" placeholder="Type Resolucion">
							<input type="button" name="submit_resolucion" value="Submit" />


						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>






	<input type="hidden" name="incident_ID" value="" />


	<table width="100%" class="muslimraza" style="margin-top:30px">

		<tr>
			<td width="45%">
				<?php echo DropdownHelper::categories_dropdown_HTML(); ?>
			</td>

			<td width="10%"></td>
			<td width="45%">

				<?php echo DropdownHelper::track_dropdown_HTML(); ?>

			</td>
		</tr>
	</table>



	<div class="incident_list" style="margin-top:20px">
		<?php
		echo $this->incidents_list_html->display();
		?>


	</div>

	<p style="height: 30px;">

	</p>


</div>