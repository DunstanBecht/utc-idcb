<?php
/**
 * This file defines the tree.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package tabs\guide
 */

namespace controllers;

new Radio('is_a_dm', array('yes'=>'A', 'no'=>'B'));
new Radio('A', array('yes'=>'is_a_dm', 'no'=>'is_a_dm'));
new Radio('B', array('yes'=>'is_a_dm', 'no'=>'is_a_dm'));
/*
new Upload('state_of_the_art', 'is_ce_marked');
new Radio('is_ce_marked', array('yes'=>'', 'no'=>'is_innovative'));
new Radio('is_innovative', array('yes'=>'clinical_assessment', 'no'=>'equivalence'));

new Upload('clinical_assessment', 'edit');
new Upload('equivalence', 'skip_investigation');

new Hidden('skip_investigation', '')
*/
