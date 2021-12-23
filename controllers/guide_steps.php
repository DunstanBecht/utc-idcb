<?php
/**
 * This file defines the tree.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package tabs\guide
 */

namespace controllers\steps;

new Radio('is_a_dm', array('yes'=>'select_class',
                            'no'=>'see_other'));

new Radio('see_other', array('null'=>'',
                             'null'=>''));

new Radio('select_class', array('1'=>'class_1',
                                '2'=>'class_2',
                                '3'=>'class_3',
                                '4'=>'class_4'));

new Define('class_1', 'class', '1', 'edit');
new Define('class_2', 'class', '2', 'edit');
new Define('class_3', 'class', '3', 'edit');
new Define('class_4', 'class', '4', 'edit');


new Radio('edit', array('see'=>'see',
                        'null'=>''));

new Match('see', 'class', array('1'=>'test_1',
                                '2'=>'test_2',
                                '3'=>'test_3',
                                '4'=>'test_4'));

new Radio('test_1', array('null'=>'', 'null'=>''));
new Radio('test_2', array('null'=>'', 'null'=>''));
new Radio('test_3', array('null'=>'', 'null'=>''));
new Radio('test_4', array('null'=>'', 'null'=>''));
