<div class="reservation">
    <div class="reservation-form" <?php echo spyropress_build_atts( array( 'animation' => esc_attr( $spyropress_animation ) , 'animation-delay' => esc_attr( $spyropress_delay ) ), 'data-' ); ?> >
        <div class="open-table-container" data-restaurant-id="<?php echo esc_attr( $spyropress_restaurant_id ); ?>">
            <div id="OT_searchWrapperAll">
                <form name="ism" id="ism" method="POST" action="https://secure.opentable.com/ism/interim.aspx">
                    <div id="OT_searchWrapper">
                        <div id="OT_defList" class="row">
                            <div id="OT_date" class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo esc_html( $spyropress_date ); ?></label>
                                    <input type="text" id="datepicker" class="OT_feedFormfieldCalendar datepicker" name="startDate" placeholder="<?php esc_attr__( 'Pick a date', 'tomato' )?>" />
                                    <i class="fa fa-calendar-o"></i>
                                </div>
                            </div>
                            <div id="OT_partySize" class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo esc_html( $spyropress_guests ); ?></label>
                                    <select name="PartySize" class="feedFormField">
                                        <option selected disabled><?php echo esc_html__( 'How many of you?', 'tomato' ); ?></option>
                                        <?php 
                                            for ($i = 1; $i < 20; $i++){
                                                echo '<option value="'. esc_attr( $i ) .'">'.  esc_html( $i ) .' '. esc_html__( 'Person', 'tomato' ) .'</option>';
                                            }
                                        
                                        ?>
                                    </select>
                                    <i class="fa fa-user"></i>
                                </div>
                            </div>
                            <div id="OT_time" class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo esc_html( $spyropress_time ); ?></label>
                                    <select name="ResTime" class="feedFormField">
                                        <option selected disabled><?php echo esc_html__( 'Pick a time', 'tomato' ); ?></option>
                                        <option value="12:00 AM"><?php _e( '12:00 AM', 'tomato' ); ?></option>			
            							<option value="12:30 AM"><?php _e( '12:30 AM', 'tomato' ); ?></option>			
            							<option value="1:00 AM"><?php _e( '1:00 AM', 'tomato' ); ?></option>			
            							<option value="1:30 AM"><?php _e( '1:30 AM', 'tomato' ); ?></option>			
            							<option value="2:00 AM"><?php _e( '2:00 AM', 'tomato' ); ?></option>			
            							<option value="2:30 AM"><?php _e( '2:30 AM', 'tomato' ); ?></option>			
            							<option value="3:00 AM"><?php _e( '3:00 AM', 'tomato' ); ?></option>			
            							<option value="3:30 AM"><?php _e( '3:30 AM', 'tomato' ); ?></option>			
            							<option value="4:00 AM"><?php _e( '4:00 AM', 'tomato' ); ?></option>			
            							<option value="4:30 AM"><?php _e( '4:30 AM', 'tomato' ); ?></option>			
            							<option value="5:00 AM"><?php _e( '5:00 AM', 'tomato' ); ?></option>			
            							<option value="5:30 AM"><?php _e( '5:30 AM', 'tomato' ); ?></option>			
            							<option value="6:00 AM"><?php _e( '6:00 AM', 'tomato' ); ?></option>			
            							<option value="6:30 AM"><?php _e( '6:30 AM', 'tomato' ); ?></option>			
            							<option value="7:00 AM"><?php _e( '7:00 AM', 'tomato' ); ?></option>			
            							<option value="7:30 AM"><?php _e( '7:30 AM', 'tomato' ); ?></option>			
            							<option value="8:00 AM"><?php _e( '8:00 AM', 'tomato' ); ?></option>			
            							<option value="8:30 AM"><?php _e( '8:30 AM', 'tomato' ); ?></option>			
            							<option value="9:00 AM"><?php _e( '9:00 AM', 'tomato' ); ?></option>			
            							<option value="9:30 AM"><?php _e( '9:30 AM', 'tomato' ); ?></option>			
            							<option value="10:00 AM"><?php _e( '10:00 AM', 'tomato' ); ?></option>			
            							<option value="10:30 AM"><?php _e( '10:30 AM', 'tomato' ); ?></option>			
            							<option value="11:00 AM"><?php _e( '11:00 AM', 'tomato' ); ?></option>			
            							<option value="11:30 AM"><?php _e( '11:30 AM', 'tomato' ); ?></option>			
            							<option value="12:00 PM"><?php _e( '12:00 PM', 'tomato' ); ?></option>			
            							<option value="12:30 PM"><?php _e( '12:30 PM', 'tomato' ); ?></option>			
            							<option value="1:00 PM"><?php _e( '1:00 PM', 'tomato' ); ?></option>			
            							<option value="1:30 PM"><?php _e( '1:30 PM', 'tomato' ); ?></option>			
            							<option value="2:00 PM"><?php _e( '2:00 PM', 'tomato' ); ?></option>			
            							<option value="2:30 PM"><?php _e( '2:30 PM', 'tomato' ); ?></option>			
            							<option value="3:00 PM"><?php _e( '3:00 PM', 'tomato' ); ?></option>			
            							<option value="3:30 PM"><?php _e( '3:30 PM', 'tomato' ); ?></option>			
            							<option value="4:00 PM"><?php _e( '4:00 PM', 'tomato' ); ?></option>			
            							<option value="4:30 PM"><?php _e( '4:30 PM', 'tomato' ); ?></option>			
            							<option value="5:00 PM"><?php _e( '5:00 PM', 'tomato' ); ?></option>			
            							<option value="5:30 PM"><?php _e( '5:30 PM', 'tomato' ); ?></option>			
            							<option value="6:00 PM"><?php _e( '6:00 PM', 'tomato' ); ?></option>			
            							<option value="6:30 PM"><?php _e( '6:30 PM', 'tomato' ); ?></option>			
            							<option value="7:00 PM"><?php _e( '7:00 PM', 'tomato' ); ?></option>			
            							<option value="7:30 PM"><?php _e( '7:30 PM', 'tomato' ); ?></option>			
            							<option value="8:00 PM"><?php _e( '8:00 PM', 'tomato' ); ?></option>			
            							<option value="8:30 PM"><?php _e( '8:30 PM', 'tomato' ); ?></option>			
            							<option value="9:00 PM"><?php _e( '9:00 PM', 'tomato' ); ?></option>			
            							<option value="9:30 PM"><?php _e( '9:30 PM', 'tomato' ); ?></option>			
            							<option value="10:00 PM"><?php _e( '10:00 PM', 'tomato' ); ?></option>			
            							<option value="10:30 PM"><?php _e( '10:30 PM', 'tomato' ); ?></option>			
            							<option value="11:00 PM"><?php _e( '11:00 PM', 'tomato' ); ?></option>			
            							<option value="11:30 PM"><?php _e( '11:30 PM', 'tomato' ); ?></option>  
                                    </select>
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="OT_submitWrap" class="reservation-btn">
                        <button type="submit" class="btn btn-default btn-lg OT_TableButton"><?php echo esc_html( $spyropress_btn ); ?></button>
                    </div>
    
                    <!-- // end .text-center -->
                    <div class="OT_hidden">
                        <input type="hidden" class="OT_hidden" name="RestaurantID" value="">
                        <input type="hidden" class="OT_hidden" name="GeoID" value="7">
                        <input type="hidden" class="OT_hidden" name="txtHidServerTime" value="6/26/2014 8:50 PM">
                        <input type="hidden" class="OT_hidden" name="txtDateFormat" value="MM/dd/yyyy">
                    </div>
                </form>
                <noscript>&amp;lt;a href="http://www.omniture.com" title="Web Analytics"&amp;gt;&amp;lt;img src="http://o.opentable.com/b/ss/otrestref/1/H.22.1--NS/0" height="1" width="1" border="0"  /&amp;gt;&amp;lt;/a&amp;gt;</noscript>
                <!--/DO NOT REMOVE/-->
            </div>
        </div>
    </div>
    <?php if( $spyropress_frm_footer ): ?>
        <div class="reservation-footer">
            <p><?php echo wp_kses( $spyropress_frm_footer, array( 'strong' => array() ) ); ?></p>
            <span></span>
        </div>
    <?php endif; ?>
</div>