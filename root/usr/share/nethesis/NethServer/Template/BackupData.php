<?php

echo $view->header()->setAttribute('template', $T('BackupData_Title'));
$general = $view->panel()
    ->setAttribute('title', $T('BackupData_General_Title'))
    ->insert($view->checkbox('status','enabled')->setAttribute('uncheckedValue', 'disabled'))
    ->insert($view->textInput('BackupTime'))

    ->insert($view->fieldset()->setAttribute('template',$T('BackupDataType_label'))
        ->insert($view->fieldsetSwitch('Type', 'full'))
        ->insert($view->fieldsetSwitch('Type', 'incremental', $view::FIELDSETSWITCH_EXPANDABLE)
            ->insert($view->selector('FullDay', $view::SELECTOR_DROPDOWN))
        )
     )

    ->insert($view->fieldset()->setAttribute('template',$T('RetentionPolicy_label'))
        ->insert($view->selector('CleanupOlderThan', $view::SELECTOR_DROPDOWN))
     )

;
$destination = $view->panel()
    ->setAttribute('title', $T('BackupData_Destination_Title'))
    ->insert($view->fieldsetSwitch('VFSType', 'usb',$view::FIELDSETSWITCH_EXPANDABLE)
        ->insert($view->selector('USBLabel', $view::SELECTOR_DROPDOWN))
    )
    ->insert($view->fieldsetSwitch('VFSType', 'cifs',$view::FIELDSETSWITCH_EXPANDABLE)
        ->insert($view->textInput('SMBHost'))
        ->insert($view->textInput('SMBShare'))
        ->insert($view->textInput('SMBLogin'))
        ->insert($view->textInput('SMBPassword'))
    )
    ->insert($view->fieldsetSwitch('VFSType', 'nfs',$view::FIELDSETSWITCH_EXPANDABLE)
        ->insert($view->textInput('NFSHost'))
        ->insert($view->textInput('NFSShare'))
    )
;

$notification = $view->panel()
    ->setAttribute('title', $T('BackupData_Notification_Title'))
    ->insert($view->fieldset()->setAttribute('template',$T('notify_label'))
        ->insert($view->fieldsetSwitch('notify', 'error'))
        ->insert($view->fieldsetSwitch('notify', 'always'))
        ->insert($view->fieldsetSwitch('notify', 'never'))
     )

    ->insert($view->fieldset()->setAttribute('template',$T('notifyTo_label'))
        ->insert($view->fieldsetSwitch('notifyToType', 'admin'))
        ->insert($view->fieldsetSwitch('notifyToType', 'custom', $view::FIELDSETSWITCH_EXPANDABLE)
            ->insert($view->textInput('notifyToCustom'))
        )
    )
;


$tabs = $view->tabs()
    ->insert($general)
    ->insert($destination)
    ->insert($notification)
;

echo $tabs;

echo $view->buttonList($view::BUTTON_SUBMIT | $view::BUTTON_HELP);

