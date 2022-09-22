```uml
@startuml

skinparam class {
    '図の背景
    BackgroundColor Snow
    '図の枠
    BorderColor Black
    'リレーションの色
    ArrowColor Black
}

!define MASTER_MARK_COLOR Orange 
!define TRANSACTION_MARK_COLOR DeepSkyBlue

package "Cyclingre" as target_system {
    /'
      マスターテーブルを M、トランザクションを T などで表記
      １文字なら "主" とか "従" まど日本語でも記載可能
     '/
    
    
    entity "ユーザーマスタ" as users  <m_users> <<M,MASTER_MARK_COLOR>> {
        + user_id[PK]
        --
        user_name
        # userimage_id [FK]
        user_mail
        user_pass
        age
        sex_Flag
        reg_date
        upd_date
        del_date
    }
    
    entity "プレユーザーマスタ" as pre_users  <m_pre_users> <<M,MASTER_MARK_COLOR>> {
        + pre_user_id[PK]
        --
        pre_user_mail
        pre_user_token
        reg_date
        upd_date
        del_date
    }
    
    entity "コースマスタ" as course <m_course> <<M,MASTER_MARK_COLOR>> {
        + course_id [PK]
        --
        course_name
        # user_id [FK]
        checkpoint_num
        reg_date
        upd_date
        del_date
    }
    
    entity "コースカテゴリマスタ" as courseCategory <m_courseCategory> <<M,MASTER_MARK_COLOR>> {
        + course_id [PK][FK]
        + courseCategory_id [PK][FK]
        --
        reg_date
        upd_date
        del_date
    }
    
    
    entity "コースカテゴリIDマスタ" as courseCategoryID <m_courseCategoryID> <<M,MASTER_MARK_COLOR>> {
        + courseCategory_id [PK]
        --
        course_name
        reg_date
        upd_date
        del_date
    }
    
     entity "チェックポイントマスタ" as checkpoint <m_checkpoint> <<M,MASTER_MARK_COLOR>> {
        + checkpoint_id [PK]
        --
        checkpoint_name
        checkpoint_latitude
        checkpoint_longitude
        checkpoint_explanation
        # user_id [FK]
        reg_date
        upd_date
        del_date
    }
    
     entity "チェックポイントカテゴリマスタ" as checkpointCategory <m_checkpointCategory> <<M,MASTER_MARK_COLOR>> {
        + checkpoint_id [PK][FK]
        + checkpointCategory_id [PK][FK]
        --
        reg_date
        upd_date
        del_date
    }
    
     entity "チェックポイントカテゴリIDマスタ" as checkpointCategoryID <m_checkpointCategoryID> <<M,MASTER_MARK_COLOR>> {
        + checkpointCategory_id [PK]
        --
        checkpoint_name
        reg_date
        upd_date
        del_date
    }
    
     entity "コースチェックポイントマスタ" as course_checkpoint <m_course_checkpoint> <<M,MASTER_MARK_COLOR>> {
        + course_id [PK][FK]
        + checkpoint_id [PK][FK]
        --
        checkpoint_num
        reg_date
        upd_date
        del_date
    }
    
     entity "コース履歴テーブル" as CourseHistory <t_CourseHistory> <<T,TRANSACTION_MARK_COLOR>> {
        + courseHistory_id [PK]
        + user_id [PK][FK]
        --
        # course_id [FK]
        start_time
        end_time
        distance
        end_Flag
        reg_date
        del_date
    }
    
    entity "コースチェックポイント履歴テーブル" as course_checkpoint_History <t_course_checkpoint_History> <<T,TRANSACTION_MARK_COLOR>> {
        + checkpointHistory_id [PK]
        + user_id [PK][FK]
        --
        # checkpoint_id [FK]
        # courseHistory_id [FK]
        start_time
        end_time
        distance
        end_Flag
        reg_date
        del_date
    }
    
    entity "マイコーステーブル" as myCourse <t_myCourse> <<T,TRANSACTION_MARK_COLOR>> {
        + mycourse_id [PK]
        + user_id [PK][FK]
        --
        # course_id [FK]
        reg_date
        upd_date
        del_date
    }
    
        
    entity "検索履歴テーブル" as searchHistory <t_searchHistory> <<T,TRANSACTION_MARK_COLOR>> {
        + user_id [PK][FK]
        + searchHistory_id [PK]
        --
        searchWord
        reg_date
        upd_date
        del_date
    }
    
    entity "チェックポイント写真マスタ" as checkpointPhoto <m_checkpointPhoto> <<M,MASTER_MARK_COLOR>> {
        + photo_id [PK]
        + checkpoint_id [PK][FK]
        --
        photo_name
        # user_id [FK]
        reg_date
        del_date
    } 
    
    entity "ユーザー画像マスタ" as userImage <m_userImage> <<M,MASTER_MARK_COLOR>> {
        + userimage_id [PK]
        + user_id [PK][FK]
        --
        userimage_name
        reg_date
        del_date
    } 
    
    entity "掲示板テーブル" as bulletinBoard <t_bulletinBoard> <<T,TRANSACTION_MARK_COLOR>> {
        + bulletinBoard_id [PK]
        --
        # user_id [FK]
        bulletinBoard_title
        # course_id[FK]
        reg_date
        upd_date
        del_date
    }
    
    entity "掲示板コメントテーブル" as bulletinBoardComment <t_bulletinBoardComment> <<T,TRANSACTION_MARK_COLOR>> {
        + bulletinBoard_id [PK]
        + comment_id [FK]
        --
        # user_id [FK]
        comment
        commentDestination_id
        good_count
        reg_date
        upd_date
        del_date
    }
    
    entity "募集掲示板テーブル" as RecruitmentBulletinBoard <t_RecruitmentBulletinBoard> <<T,TRANSACTION_MARK_COLOR>> {
        + RecruitmentbulletinBoard_id [PK]
        --
        # user_id [FK]
        RecruitmentbulletinBoard_title
        # course_id[FK]
        schedule_date
        participantUser_num
        reg_date
        upd_date
        del_date
    }
    
    entity "募集掲示板コメントテーブル" as RecruitmentBulletinBoardComment <t_RecruitmentBulletinBoardComment> <<T,TRANSACTION_MARK_COLOR>> {
        + RecruitmentbulletinBoard_id [PK]
        + comment_id [FK]
        --
        # user_id [FK]
        comment
        commentDestination_id
        good_count
        reg_date
        upd_date
        del_date
    }
    
     entity "参加者テーブル" as participantUser <t_participantUser> <<T,TRANSACTION_MARK_COLOR>> {
        + RecruitmentbulletinBoard_id [PK][FK]
        + user_id [PK][FK]
        --
        participant_num
        reg_date
        upd_date
        del_date
    }

  }


searchHistory                   }o-ri-o|   users
course                          }o-d-o|   course_checkpoint 
checkpoint                      }o-up-o|   course_checkpoint
course                          }o-ri-o|   courseCategory
courseCategoryID                }o-le-o|   courseCategory
checkpoint                      }o-d-o|   checkpointCategory
checkpointCategoryID            }o-le-o|   checkpointCategory
CourseHistory                   }o-up-o|   course 
course_checkpoint_History       }o-ri-o|   checkpoint
course_checkpoint_History       }o-up-o|   CourseHistory
myCourse                        }o-up-o|   course 
bulletinBoardComment            }o-le-o|   bulletinBoard 
RecruitmentBulletinBoardComment }o-d-o|   RecruitmentBulletinBoard 
RecruitmentBulletinBoard        }o-up-o|   participantUser
checkpoint                      }o-up-o|   checkpointPhoto
users                           }o-ri-o|   course
users                           }o-ri-o|   checkpoint
users                           }o-d-o|   CourseHistory
users                           }o-up-o|   course_checkpoint_History
users                           }o-up-o|   myCourse
users                           }o-up-o|   bulletinBoard
users                           }o-up-o|   bulletinBoardComment
users                           }o-d-o|   RecruitmentBulletinBoard
users                           }o-d-o|   RecruitmentBulletinBoardComment
users                           }o-d-o|   participantUser
users                           }o-d-o|   checkpointPhoto
users                           }o-up-o|   userImage
pre_users                       }o-ri-o|   users
       

@enduml
```

