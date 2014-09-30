#Suma 3 a 5 años total 
select
sum (
    (select total from educacion_edades where  edad like "%03 años%" and municipio like "%<municipio>%") +
    (select total from educacion_edades where  edad like "%04 años%" and municipio like "%<municipio>%") +
    (select total from educacion_edades where  edad like "%05 años%" and municipio like "%<municipio>%")
)   as total
#Suma 3 a 5 total de asistentes 
select
sum (
    (select total_asiste from educacion_edades where  edad like "%03 años%" and municipio like "%<municipio>%") +
    (select total_asiste from educacion_edades where  edad like "%04 años%" and municipio like "%<municipio>%") +
    (select total_asiste from educacion_edades where  edad like "%05 años%" and municipio like "%<municipio>%")
)   as total
#Suma 3 a 5 total asistentes hombres
select
sum (
    (select hombres_asiste from educacion_edades where  edad like "%03 años%" and municipio like "%<municipio>%") +
    (select hombres_asiste from educacion_edades where  edad like "%04 años%" and municipio like "%<municipio>%") +
    (select hombres_asiste from educacion_edades where  edad like "%05 años%" and municipio like "%<municipio>%")
)
#Suma 3 a 5 total asistentes mujeres
select
sum (
    (select mujeres_asiste from educacion_edades where  edad like "%03 años%" and municipio like "%<municipio>%") +
    (select mujeres_asiste from educacion_edades where  edad like "%04 años%" and municipio like "%<municipio>%") +
    (select mujeres_asiste from educacion_edades where  edad like "%05 años%" and municipio like "%<municipio>%")
)
#------------------------------------------------------------------------------------------------------------------------
#------------------------------------------------------------------------------------------------------------------------

#Suma 6 a 11 años total 
select
sum (
    (select total from educacion_edades where  edad like "%06 años%" and municipio like "%<municipio>%") +
    (select total from educacion_edades where  edad like "%07 años%" and municipio like "%<municipio>%") +
    (select total from educacion_edades where  edad like "%08 años%" and municipio like "%<municipio>%") +
    (select total from educacion_edades where  edad like "%09 años%" and municipio like "%<municipio>%") +
    (select total from educacion_edades where  edad like "%10 años%" and municipio like "%<municipio>%") +
    (select total from educacion_edades where  edad like "%11 años%" and municipio like "%<municipio>%")
)   as total

#Suma 6 a 11 años total asistentes
select
sum (
    (select total_asiste from educacion_edades where  edad like "%06 años%" and municipio like "%<municipio>%") +
    (select total_asiste from educacion_edades where  edad like "%07 años%" and municipio like "%<municipio>%") +
    (select total_asiste from educacion_edades where  edad like "%08 años%" and municipio like "%<municipio>%") +
    (select total_asiste from educacion_edades where  edad like "%09 años%" and municipio like "%<municipio>%") +
    (select total_asiste from educacion_edades where  edad like "%10 años%" and municipio like "%<municipio>%") +
    (select total_asiste from educacion_edades where  edad like "%11 años%" and municipio like "%<municipio>%")
)   as total

#Suma 6 a 11 años total asistentes hombres
select
sum (
    (select hombres_asiste from educacion_edades where  edad like "%06 años%" and municipio like "%<municipio>%") +
    (select hombres_asiste from educacion_edades where  edad like "%07 años%" and municipio like "%<municipio>%") +
    (select hombres_asiste from educacion_edades where  edad like "%08 años%" and municipio like "%<municipio>%") +
    (select hombres_asiste from educacion_edades where  edad like "%09 años%" and municipio like "%<municipio>%") +
    (select hombres_asiste from educacion_edades where  edad like "%10 años%" and municipio like "%<municipio>%") +
    (select hombres_asiste from educacion_edades where  edad like "%11 años%" and municipio like "%<municipio>%")
)   as total

#Suma 6 a 11 años total asistentes mujeres
select
sum (
    (select mujeres_asiste from educacion_edades where  edad like "%06 años%" and municipio like "%<municipio>%") +
    (select mujeres_asiste from educacion_edades where  edad like "%07 años%" and municipio like "%<municipio>%") +
    (select mujeres_asiste from educacion_edades where  edad like "%08 años%" and municipio like "%<municipio>%") +
    (select mujeres_asiste from educacion_edades where  edad like "%09 años%" and municipio like "%<municipio>%") +
    (select mujeres_asiste from educacion_edades where  edad like "%10 años%" and municipio like "%<municipio>%") +
    (select mujeres_asiste from educacion_edades where  edad like "%11 años%" and municipio like "%<municipio>%")
)   as total
#------------------------------------------------------------------------------------------------------------------------
#------------------------------------------------------------------------------------------------------------------------


#Suma de 12 a 14 años total 
select
sum (
    (select total from educacion_edades where  edad like "%12 años%" and municipio like "%<municipio>%") +
    (select total from educacion_edades where  edad like "%13 años%" and municipio like "%<municipio>%") +
    (select total from educacion_edades where  edad like "%14 años%" and municipio like "%<municipio>%")
)   as total

#Suma de 12 a 14 años total asistentes
select
sum (
    (select total_asiste from educacion_edades where  edad like "%12 años%" and municipio like "%<municipio>%") +
    (select total_asiste from educacion_edades where  edad like "%13 años%" and municipio like "%<municipio>%") +
    (select total_asiste from educacion_edades where  edad like "%14 años%" and municipio like "%<municipio>%")
)   as total

#Suma de 12 a 14 años total asistentes hombres
select
sum (
    (select hombres_asiste from educacion_edades where  edad like "%12 años%" and municipio like "%<municipio>%") +
    (select hombres_asiste from educacion_edades where  edad like "%13 años%" and municipio like "%<municipio>%") +
    (select hombres_asiste from educacion_edades where  edad like "%14 años%" and municipio like "%<municipio>%")
)   as total

#Suma de 12 a 14 años total asistentes mujeres
select
sum (
    (select mujeres_asiste from educacion_edades where  edad like "%12 años%" and municipio like "%<municipio>%") +
    (select mujeres_asiste from educacion_edades where  edad like "%13 años%" and municipio like "%<municipio>%") +
    (select mujeres_asiste from educacion_edades where  edad like "%14 años%" and municipio like "%<municipio>%")
)   as total
#------------------------------------------------------------------------------------------------------------------------
#------------------------------------------------------------------------------------------------------------------------

#Suma de 15 a 24 años total
select
sum (
    (select total from educacion_edades where  edad like "%15 años%" and municipio like "%<municipio>%") +
    (select total from educacion_edades where  edad like "%16 años%" and municipio like "%<municipio>%") +
    (select total from educacion_edades where  edad like "%17 años%" and municipio like "%<municipio>%") +
    (select total from educacion_edades where  edad like "%18 años%" and municipio like "%<municipio>%") +
    (select total from educacion_edades where  edad like "%19 años%" and municipio like "%<municipio>%") +
    (select total from educacion_edades where  edad like "%20-24 años%" and municipio like "%<municipio>%")
)   as total

#Suma de 15 a 24 años total asistentes
select
sum (
    (select total_asiste from educacion_edades where  edad like "%15 años%" and municipio like "%<municipio>%") +
    (select total_asiste from educacion_edades where  edad like "%16 años%" and municipio like "%<municipio>%") +
    (select total_asiste from educacion_edades where  edad like "%17 años%" and municipio like "%<municipio>%") +
    (select total_asiste from educacion_edades where  edad like "%18 años%" and municipio like "%<municipio>%") +
    (select total_asiste from educacion_edades where  edad like "%19 años%" and municipio like "%<municipio>%") +
    (select total_asiste from educacion_edades where  edad like "%20-24 años%" and municipio like "%<municipio>%")
)   as total

#Suma de 15 a 24 años total asistentes hombres
select
sum (
    (select hombres_asiste from educacion_edades where  edad like "%15 años%" and municipio like "%<municipio>%") +
    (select hombres_asiste from educacion_edades where  edad like "%16 años%" and municipio like "%<municipio>%") +
    (select hombres_asiste from educacion_edades where  edad like "%17 años%" and municipio like "%<municipio>%") +
    (select hombres_asiste from educacion_edades where  edad like "%18 años%" and municipio like "%<municipio>%") +
    (select hombres_asiste from educacion_edades where  edad like "%19 años%" and municipio like "%<municipio>%") +
    (select hombres_asiste from educacion_edades where  edad like "%20-24 años%" and municipio like "%<municipio>%")
)   as total

#Suma de 15 a 24 años total asistentes mujeres
select
sum (
    (select mujeres_asiste from educacion_edades where  edad like "%15 años%" and municipio like "%<municipio>%") +
    (select mujeres_asiste from educacion_edades where  edad like "%16 años%" and municipio like "%<municipio>%") +
    (select mujeres_asiste from educacion_edades where  edad like "%17 años%" and municipio like "%<municipio>%") +
    (select mujeres_asiste from educacion_edades where  edad like "%18 años%" and municipio like "%<municipio>%") +
    (select mujeres_asiste from educacion_edades where  edad like "%19 años%" and municipio like "%<municipio>%") +
    (select mujeres_asiste from educacion_edades where  edad like "%20-24 años%" and municipio like "%<municipio>%")
)   as total
