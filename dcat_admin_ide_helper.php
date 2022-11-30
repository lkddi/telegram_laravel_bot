<?php

/**
 * A helper file for Dcat Admin, to provide autocomplete information to your IDE
 *
 * This file should not be included in your code, only analyzed by your IDE!
 *
 * @author jqh <841324345@qq.com>
 */
namespace Dcat\Admin {
    use Illuminate\Support\Collection;

    /**
     * @property Grid\Column|Collection id
     * @property Grid\Column|Collection name
     * @property Grid\Column|Collection type
     * @property Grid\Column|Collection version
     * @property Grid\Column|Collection detail
     * @property Grid\Column|Collection created_at
     * @property Grid\Column|Collection updated_at
     * @property Grid\Column|Collection is_enabled
     * @property Grid\Column|Collection parent_id
     * @property Grid\Column|Collection order
     * @property Grid\Column|Collection icon
     * @property Grid\Column|Collection uri
     * @property Grid\Column|Collection extension
     * @property Grid\Column|Collection permission_id
     * @property Grid\Column|Collection menu_id
     * @property Grid\Column|Collection slug
     * @property Grid\Column|Collection http_method
     * @property Grid\Column|Collection http_path
     * @property Grid\Column|Collection role_id
     * @property Grid\Column|Collection user_id
     * @property Grid\Column|Collection value
     * @property Grid\Column|Collection username
     * @property Grid\Column|Collection password
     * @property Grid\Column|Collection avatar
     * @property Grid\Column|Collection remember_token
     * @property Grid\Column|Collection uuid
     * @property Grid\Column|Collection connection
     * @property Grid\Column|Collection queue
     * @property Grid\Column|Collection payload
     * @property Grid\Column|Collection exception
     * @property Grid\Column|Collection failed_at
     * @property Grid\Column|Collection chat_id
     * @property Grid\Column|Collection invite_link
     * @property Grid\Column|Collection status
     * @property Grid\Column|Collection open
     * @property Grid\Column|Collection vmethod
     * @property Grid\Column|Collection overtime
     * @property Grid\Column|Collection verror
     * @property Grid\Column|Collection passedconut
     * @property Grid\Column|Collection errorconut
     * @property Grid\Column|Collection can_be_edited
     * @property Grid\Column|Collection can_manage_chat
     * @property Grid\Column|Collection can_change_info
     * @property Grid\Column|Collection can_delete_messages
     * @property Grid\Column|Collection can_invite_users
     * @property Grid\Column|Collection can_restrict_members
     * @property Grid\Column|Collection can_pin_messages
     * @property Grid\Column|Collection can_manage_topics
     * @property Grid\Column|Collection can_promote_members
     * @property Grid\Column|Collection can_manage_video_chats
     * @property Grid\Column|Collection is_anonymous
     * @property Grid\Column|Collection can_manage_voice_chats
     * @property Grid\Column|Collection email
     * @property Grid\Column|Collection token
     * @property Grid\Column|Collection tokenable_type
     * @property Grid\Column|Collection tokenable_id
     * @property Grid\Column|Collection abilities
     * @property Grid\Column|Collection last_used_at
     * @property Grid\Column|Collection expires_at
     * @property Grid\Column|Collection message_id
     * @property Grid\Column|Collection text
     * @property Grid\Column|Collection deltime
     * @property Grid\Column|Collection state
     * @property Grid\Column|Collection group_id
     * @property Grid\Column|Collection first_name
     * @property Grid\Column|Collection last_name
     * @property Grid\Column|Collection sequence
     * @property Grid\Column|Collection batch_id
     * @property Grid\Column|Collection family_hash
     * @property Grid\Column|Collection should_display_on_index
     * @property Grid\Column|Collection content
     * @property Grid\Column|Collection entry_uuid
     * @property Grid\Column|Collection tag
     * @property Grid\Column|Collection email_verified_at
     * @property Grid\Column|Collection update_id
     * @property Grid\Column|Collection from_id
     * @property Grid\Column|Collection from
     * @property Grid\Column|Collection chat
     *
     * @method Grid\Column|Collection id(string $label = null)
     * @method Grid\Column|Collection name(string $label = null)
     * @method Grid\Column|Collection type(string $label = null)
     * @method Grid\Column|Collection version(string $label = null)
     * @method Grid\Column|Collection detail(string $label = null)
     * @method Grid\Column|Collection created_at(string $label = null)
     * @method Grid\Column|Collection updated_at(string $label = null)
     * @method Grid\Column|Collection is_enabled(string $label = null)
     * @method Grid\Column|Collection parent_id(string $label = null)
     * @method Grid\Column|Collection order(string $label = null)
     * @method Grid\Column|Collection icon(string $label = null)
     * @method Grid\Column|Collection uri(string $label = null)
     * @method Grid\Column|Collection extension(string $label = null)
     * @method Grid\Column|Collection permission_id(string $label = null)
     * @method Grid\Column|Collection menu_id(string $label = null)
     * @method Grid\Column|Collection slug(string $label = null)
     * @method Grid\Column|Collection http_method(string $label = null)
     * @method Grid\Column|Collection http_path(string $label = null)
     * @method Grid\Column|Collection role_id(string $label = null)
     * @method Grid\Column|Collection user_id(string $label = null)
     * @method Grid\Column|Collection value(string $label = null)
     * @method Grid\Column|Collection username(string $label = null)
     * @method Grid\Column|Collection password(string $label = null)
     * @method Grid\Column|Collection avatar(string $label = null)
     * @method Grid\Column|Collection remember_token(string $label = null)
     * @method Grid\Column|Collection uuid(string $label = null)
     * @method Grid\Column|Collection connection(string $label = null)
     * @method Grid\Column|Collection queue(string $label = null)
     * @method Grid\Column|Collection payload(string $label = null)
     * @method Grid\Column|Collection exception(string $label = null)
     * @method Grid\Column|Collection failed_at(string $label = null)
     * @method Grid\Column|Collection chat_id(string $label = null)
     * @method Grid\Column|Collection invite_link(string $label = null)
     * @method Grid\Column|Collection status(string $label = null)
     * @method Grid\Column|Collection open(string $label = null)
     * @method Grid\Column|Collection vmethod(string $label = null)
     * @method Grid\Column|Collection overtime(string $label = null)
     * @method Grid\Column|Collection verror(string $label = null)
     * @method Grid\Column|Collection passedconut(string $label = null)
     * @method Grid\Column|Collection errorconut(string $label = null)
     * @method Grid\Column|Collection can_be_edited(string $label = null)
     * @method Grid\Column|Collection can_manage_chat(string $label = null)
     * @method Grid\Column|Collection can_change_info(string $label = null)
     * @method Grid\Column|Collection can_delete_messages(string $label = null)
     * @method Grid\Column|Collection can_invite_users(string $label = null)
     * @method Grid\Column|Collection can_restrict_members(string $label = null)
     * @method Grid\Column|Collection can_pin_messages(string $label = null)
     * @method Grid\Column|Collection can_manage_topics(string $label = null)
     * @method Grid\Column|Collection can_promote_members(string $label = null)
     * @method Grid\Column|Collection can_manage_video_chats(string $label = null)
     * @method Grid\Column|Collection is_anonymous(string $label = null)
     * @method Grid\Column|Collection can_manage_voice_chats(string $label = null)
     * @method Grid\Column|Collection email(string $label = null)
     * @method Grid\Column|Collection token(string $label = null)
     * @method Grid\Column|Collection tokenable_type(string $label = null)
     * @method Grid\Column|Collection tokenable_id(string $label = null)
     * @method Grid\Column|Collection abilities(string $label = null)
     * @method Grid\Column|Collection last_used_at(string $label = null)
     * @method Grid\Column|Collection expires_at(string $label = null)
     * @method Grid\Column|Collection message_id(string $label = null)
     * @method Grid\Column|Collection text(string $label = null)
     * @method Grid\Column|Collection deltime(string $label = null)
     * @method Grid\Column|Collection state(string $label = null)
     * @method Grid\Column|Collection group_id(string $label = null)
     * @method Grid\Column|Collection first_name(string $label = null)
     * @method Grid\Column|Collection last_name(string $label = null)
     * @method Grid\Column|Collection sequence(string $label = null)
     * @method Grid\Column|Collection batch_id(string $label = null)
     * @method Grid\Column|Collection family_hash(string $label = null)
     * @method Grid\Column|Collection should_display_on_index(string $label = null)
     * @method Grid\Column|Collection content(string $label = null)
     * @method Grid\Column|Collection entry_uuid(string $label = null)
     * @method Grid\Column|Collection tag(string $label = null)
     * @method Grid\Column|Collection email_verified_at(string $label = null)
     * @method Grid\Column|Collection update_id(string $label = null)
     * @method Grid\Column|Collection from_id(string $label = null)
     * @method Grid\Column|Collection from(string $label = null)
     * @method Grid\Column|Collection chat(string $label = null)
     */
    class Grid {}

    class MiniGrid extends Grid {}

    /**
     * @property Show\Field|Collection id
     * @property Show\Field|Collection name
     * @property Show\Field|Collection type
     * @property Show\Field|Collection version
     * @property Show\Field|Collection detail
     * @property Show\Field|Collection created_at
     * @property Show\Field|Collection updated_at
     * @property Show\Field|Collection is_enabled
     * @property Show\Field|Collection parent_id
     * @property Show\Field|Collection order
     * @property Show\Field|Collection icon
     * @property Show\Field|Collection uri
     * @property Show\Field|Collection extension
     * @property Show\Field|Collection permission_id
     * @property Show\Field|Collection menu_id
     * @property Show\Field|Collection slug
     * @property Show\Field|Collection http_method
     * @property Show\Field|Collection http_path
     * @property Show\Field|Collection role_id
     * @property Show\Field|Collection user_id
     * @property Show\Field|Collection value
     * @property Show\Field|Collection username
     * @property Show\Field|Collection password
     * @property Show\Field|Collection avatar
     * @property Show\Field|Collection remember_token
     * @property Show\Field|Collection uuid
     * @property Show\Field|Collection connection
     * @property Show\Field|Collection queue
     * @property Show\Field|Collection payload
     * @property Show\Field|Collection exception
     * @property Show\Field|Collection failed_at
     * @property Show\Field|Collection chat_id
     * @property Show\Field|Collection invite_link
     * @property Show\Field|Collection status
     * @property Show\Field|Collection open
     * @property Show\Field|Collection vmethod
     * @property Show\Field|Collection overtime
     * @property Show\Field|Collection verror
     * @property Show\Field|Collection passedconut
     * @property Show\Field|Collection errorconut
     * @property Show\Field|Collection can_be_edited
     * @property Show\Field|Collection can_manage_chat
     * @property Show\Field|Collection can_change_info
     * @property Show\Field|Collection can_delete_messages
     * @property Show\Field|Collection can_invite_users
     * @property Show\Field|Collection can_restrict_members
     * @property Show\Field|Collection can_pin_messages
     * @property Show\Field|Collection can_manage_topics
     * @property Show\Field|Collection can_promote_members
     * @property Show\Field|Collection can_manage_video_chats
     * @property Show\Field|Collection is_anonymous
     * @property Show\Field|Collection can_manage_voice_chats
     * @property Show\Field|Collection email
     * @property Show\Field|Collection token
     * @property Show\Field|Collection tokenable_type
     * @property Show\Field|Collection tokenable_id
     * @property Show\Field|Collection abilities
     * @property Show\Field|Collection last_used_at
     * @property Show\Field|Collection expires_at
     * @property Show\Field|Collection message_id
     * @property Show\Field|Collection text
     * @property Show\Field|Collection deltime
     * @property Show\Field|Collection state
     * @property Show\Field|Collection group_id
     * @property Show\Field|Collection first_name
     * @property Show\Field|Collection last_name
     * @property Show\Field|Collection sequence
     * @property Show\Field|Collection batch_id
     * @property Show\Field|Collection family_hash
     * @property Show\Field|Collection should_display_on_index
     * @property Show\Field|Collection content
     * @property Show\Field|Collection entry_uuid
     * @property Show\Field|Collection tag
     * @property Show\Field|Collection email_verified_at
     * @property Show\Field|Collection update_id
     * @property Show\Field|Collection from_id
     * @property Show\Field|Collection from
     * @property Show\Field|Collection chat
     *
     * @method Show\Field|Collection id(string $label = null)
     * @method Show\Field|Collection name(string $label = null)
     * @method Show\Field|Collection type(string $label = null)
     * @method Show\Field|Collection version(string $label = null)
     * @method Show\Field|Collection detail(string $label = null)
     * @method Show\Field|Collection created_at(string $label = null)
     * @method Show\Field|Collection updated_at(string $label = null)
     * @method Show\Field|Collection is_enabled(string $label = null)
     * @method Show\Field|Collection parent_id(string $label = null)
     * @method Show\Field|Collection order(string $label = null)
     * @method Show\Field|Collection icon(string $label = null)
     * @method Show\Field|Collection uri(string $label = null)
     * @method Show\Field|Collection extension(string $label = null)
     * @method Show\Field|Collection permission_id(string $label = null)
     * @method Show\Field|Collection menu_id(string $label = null)
     * @method Show\Field|Collection slug(string $label = null)
     * @method Show\Field|Collection http_method(string $label = null)
     * @method Show\Field|Collection http_path(string $label = null)
     * @method Show\Field|Collection role_id(string $label = null)
     * @method Show\Field|Collection user_id(string $label = null)
     * @method Show\Field|Collection value(string $label = null)
     * @method Show\Field|Collection username(string $label = null)
     * @method Show\Field|Collection password(string $label = null)
     * @method Show\Field|Collection avatar(string $label = null)
     * @method Show\Field|Collection remember_token(string $label = null)
     * @method Show\Field|Collection uuid(string $label = null)
     * @method Show\Field|Collection connection(string $label = null)
     * @method Show\Field|Collection queue(string $label = null)
     * @method Show\Field|Collection payload(string $label = null)
     * @method Show\Field|Collection exception(string $label = null)
     * @method Show\Field|Collection failed_at(string $label = null)
     * @method Show\Field|Collection chat_id(string $label = null)
     * @method Show\Field|Collection invite_link(string $label = null)
     * @method Show\Field|Collection status(string $label = null)
     * @method Show\Field|Collection open(string $label = null)
     * @method Show\Field|Collection vmethod(string $label = null)
     * @method Show\Field|Collection overtime(string $label = null)
     * @method Show\Field|Collection verror(string $label = null)
     * @method Show\Field|Collection passedconut(string $label = null)
     * @method Show\Field|Collection errorconut(string $label = null)
     * @method Show\Field|Collection can_be_edited(string $label = null)
     * @method Show\Field|Collection can_manage_chat(string $label = null)
     * @method Show\Field|Collection can_change_info(string $label = null)
     * @method Show\Field|Collection can_delete_messages(string $label = null)
     * @method Show\Field|Collection can_invite_users(string $label = null)
     * @method Show\Field|Collection can_restrict_members(string $label = null)
     * @method Show\Field|Collection can_pin_messages(string $label = null)
     * @method Show\Field|Collection can_manage_topics(string $label = null)
     * @method Show\Field|Collection can_promote_members(string $label = null)
     * @method Show\Field|Collection can_manage_video_chats(string $label = null)
     * @method Show\Field|Collection is_anonymous(string $label = null)
     * @method Show\Field|Collection can_manage_voice_chats(string $label = null)
     * @method Show\Field|Collection email(string $label = null)
     * @method Show\Field|Collection token(string $label = null)
     * @method Show\Field|Collection tokenable_type(string $label = null)
     * @method Show\Field|Collection tokenable_id(string $label = null)
     * @method Show\Field|Collection abilities(string $label = null)
     * @method Show\Field|Collection last_used_at(string $label = null)
     * @method Show\Field|Collection expires_at(string $label = null)
     * @method Show\Field|Collection message_id(string $label = null)
     * @method Show\Field|Collection text(string $label = null)
     * @method Show\Field|Collection deltime(string $label = null)
     * @method Show\Field|Collection state(string $label = null)
     * @method Show\Field|Collection group_id(string $label = null)
     * @method Show\Field|Collection first_name(string $label = null)
     * @method Show\Field|Collection last_name(string $label = null)
     * @method Show\Field|Collection sequence(string $label = null)
     * @method Show\Field|Collection batch_id(string $label = null)
     * @method Show\Field|Collection family_hash(string $label = null)
     * @method Show\Field|Collection should_display_on_index(string $label = null)
     * @method Show\Field|Collection content(string $label = null)
     * @method Show\Field|Collection entry_uuid(string $label = null)
     * @method Show\Field|Collection tag(string $label = null)
     * @method Show\Field|Collection email_verified_at(string $label = null)
     * @method Show\Field|Collection update_id(string $label = null)
     * @method Show\Field|Collection from_id(string $label = null)
     * @method Show\Field|Collection from(string $label = null)
     * @method Show\Field|Collection chat(string $label = null)
     */
    class Show {}

    /**
     
     */
    class Form {}

}

namespace Dcat\Admin\Grid {
    /**
     
     */
    class Column {}

    /**
     
     */
    class Filter {}
}

namespace Dcat\Admin\Show {
    /**
     
     */
    class Field {}
}
