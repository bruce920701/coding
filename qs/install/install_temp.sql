CREATE  PROCEDURE `update_user_tree`()
BEGIN
  DECLARE v_id int;
  DECLARE v_pid int;
	DECLARE v_pid1 int;
	DECLARE v_pid2 int;
	DECLARE v_pid3 int;
	DECLARE v_path varchar(255);
	DECLARE user_info cursor for select id,pid from %DB_PREFIX%user where path=0;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_id=null;
    open user_info;
			FETCH user_info into v_id,v_pid1;
					while v_id is not null and v_id>0 do
							set v_path=concat(v_id);
							if v_pid1>0 THEN
									set v_path=CONCAT(v_pid1,'.',v_path);
									set v_pid2=(select pid from %DB_PREFIX%user where id=v_pid1);
									if v_pid2>0  THEN
											set v_path=CONCAT(v_pid2,'.',v_path);
											set v_pid3=(select pid from %DB_PREFIX%user where id=v_pid2);
											if  v_pid3>0 THEN
															set v_path=CONCAT(v_pid3,'.',v_path);
											end if;
									end if;
							end if;
							set v_pid1=0;
							set v_pid2=0;
							set v_pid3=0;
							set v_path=CONCAT('.',v_path,'.');
							update %DB_PREFIX%user set path=v_path where id=v_id;
							FETCH user_info into v_id,v_pid1;
					end while;
    close user_info;
END;