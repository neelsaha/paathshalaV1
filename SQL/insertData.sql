

/*INSERT ROLE*/
INSERT INTO `role_master` (`role_id`, `role`) VALUES (NULL, 'Student'), (NULL, 'Parent'), (NULL, 'Teacher'), (NULL, 'Organization Admin'), (NULL, 'Super Admin');

/*INSERT CLASS*/
INSERT INTO `class` (`id`, `value`) VALUES (NULL, 'I'), (NULL, 'II'), (NULL, 'III'), (NULL, 'IV'), (NULL, 'V'), (NULL, 'VI'), (NULL, 'VII'), (NULL, 'VIII'), (NULL, 'IX'), (NULL, 'X'), (NULL, 'XI'), (NULL, 'XII');

/*INSERT SECTION*/
INSERT INTO `section` (`id`, `value`) VALUES (NULL, 'A'), (NULL, 'B'), (NULL, 'Science'), (NULL, 'Commerce');

/*INSERT BOARD*/
INSERT INTO `board_master` (`board_id`, `name`) VALUES (NULL, 'ICSE'), (NULL, 'CBSE');

/*INSERT ORGANIZATION*/
INSERT INTO `organization` (`organization_id`, `name`, `address`, `pincode`, `state`, `city`, `phone`, `email`, `board_id`, `isDeleted`) VALUES (NULL, 'Test School', 'Kolkata', '700028', 'West Bengal', 'Kolkata', '9876543210', 'test@test.com', '1', 'N');

/*INSERT STUDENT*/
INSERT INTO `student` (`student_id`, `registration_id`, `organization_id`, `first_name`, `last_name`, `rollno`, `class`, `section`, `attd_percentage`) VALUES (NULL, 'Test/01', '1', 'Neelanjan', 'Saha', '1', '5', '1', '100');

/*INSERT TEACHER*/
INSERT INTO `teacher` (`teacher_id`, `firstname`, `lastname`, `phone`, `qualification`, `organization_id`, `class`, `isDeleted`) VALUES (NULL, 'Test', 'Teacher', '9876543210', 'PHD in Physics', '1', '5', 'N');

/*INSERT LOGIN*/
INSERT INTO `login` (`user_id`, `username`, `password`, `first_name`, `last_name`, `mobile_number`, `student_id`, `teacher_id`, `organization_id`, `role`, `last_login`, `isDeleted`) VALUES (NULL, 'testStudent', '8D969EEF6ECAD3C29A3A629280E686CF0C3F5D5A86AFF3CA12020C923ADC6C92', 'Test', 'Student', '9876543210', '1', NULL, '1', '1', current_timestamp(), 'N');
INSERT INTO `login` (`user_id`, `username`, `password`, `first_name`, `last_name`, `mobile_number`, `student_id`, `teacher_id`, `organization_id`, `role`, `last_login`, `isDeleted`) VALUES (NULL, 'testParent', '8D969EEF6ECAD3C29A3A629280E686CF0C3F5D5A86AFF3CA12020C923ADC6C92', 'Test', 'Parent', '9876543210', '1', NULL, '1', '2', current_timestamp(), 'N');
INSERT INTO `login` (`user_id`, `username`, `password`, `first_name`, `last_name`, `mobile_number`, `student_id`, `teacher_id`, `organization_id`, `role`, `last_login`, `isDeleted`) VALUES (NULL, 'testTeacher', '8D969EEF6ECAD3C29A3A629280E686CF0C3F5D5A86AFF3CA12020C923ADC6C92', 'Test', 'Teacher', '9876543210', NULL, '1', '1', '3', current_timestamp(), 'N');
INSERT INTO `login` (`user_id`, `username`, `password`, `first_name`, `last_name`, `mobile_number`, `student_id`, `teacher_id`, `organization_id`, `role`, `last_login`, `isDeleted`) VALUES (NULL, 'testSchoolAdmin', '8D969EEF6ECAD3C29A3A629280E686CF0C3F5D5A86AFF3CA12020C923ADC6C92', 'Test', 'SchoolAdmin', '9876543210', NULL, NULL, '1', '4', current_timestamp(), 'N');
INSERT INTO `login` (`user_id`, `username`, `password`, `first_name`, `last_name`, `mobile_number`, `student_id`, `teacher_id`, `organization_id`, `role`, `last_login`, `isDeleted`) VALUES (NULL, 'testAdmin', '8D969EEF6ECAD3C29A3A629280E686CF0C3F5D5A86AFF3CA12020C923ADC6C92', 'Test', 'Admin', '9876543210', NULL, NULL, NULL, '5', current_timestamp(), 'N');

